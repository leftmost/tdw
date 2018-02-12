<?php

    /*
     * libreria per la gestione dell'autenticazione (e autorizzazione), va
     * inclusa in qualsiasi script da "proteggere"
     *
     * ERRORI:
     *
     * 1001: username o password errate
     * 1002: per accedere a questa pagina bisogna autenticarsi
     * 1003: utente non autorizzato all'esecuzione del service
     * 1004: script momentaneamente non attivo
     *
     */

    session_start(); // attiva la gestione sessione

    if ((!isset($_POST['username'])) AND (!isset($_POST['password']))) {

        /*
         * controllo se l'utente ha inserito username e password nella form di login,
         * se l'utente inserisce u e p nella form di login, lo script login.php viene
         * richiamato attraverso la action della form
         *
         */


        if (!isset($_SESSION['auth'])) {

            // non è in sessione

            Header("Location: error.php?id=1002");
            exit;
        }

    } else {


        $result = $db->getResult("SELECT username, name, surname, email FROM users
                                   WHERE username = '{$_POST['username']}'
                                     AND password = MD5('{$_POST['password']}')");

        if (!$result) {

            /* utente o password errate */

            Header("Location: error.php?id=1001");
            exit;
        }

        /*
         * username e password corrette, utente loggato
         */

        $_SESSION['auth'] = $result[0];

        /*
         * di seguito recupero i permessi dell'utente
         *
         */

        $result = $db->getResult("SELECT services.script,
                                         services.active,
                                         services.filtering
                                    FROM users
                               LEFT JOIN users_groups
                                      ON users_groups.username = users.username
                               LEFT JOIN groups
                                      ON groups.id = users_groups.id_groups
                               LEFT JOIN groups_services
                                      ON groups_services.id_groups = groups.id
                               LEFT JOIN services
                                      ON services.id = groups_services.id_services
                                   WHERE users.username = '{$_POST['username']}'
                                GROUP BY services.script");


        foreach($result as $row) {
            $permission[$row['script']] = $row;
        }

        $_SESSION['auth']['services'] = $permission;



    }

    if (!isset($_SESSION['auth']['services'][basename($_SERVER['SCRIPT_NAME'])])) {

        /* utente non autorizzato */

        Header("Location: 401.html");
        exit;


    } elseif ($_SESSION['auth']['services'][basename($_SERVER['SCRIPT_NAME'])]['active'] != '*') {

        /* script non attivo */

        Header("Location: 503.html");
        exit;

    }

    /* FILTERING */

    /*
     * HO bisogno di
     * - verificare se filtering è attivato
     * - (nome_tabella, operazione) : si recupera dal nome dello script (per es. con explode)
     * - chiave (parametro passato in GET, per esempio id)
     * - recupero chiave primaria tabella <nome_tabella>
     *          SHOW KEYS FROM <nome_tabella> WHERE Key_name = 'PRIMARY'
     *              Table
     *              Non_unique
     *              Key_name
     *              Seq_in_index
     *              Column_name <- serve questo
     *              ..
     * - SELECT username FROM <nome_tabella> WHERE Column_name = {$_REQUEST['id']}
     * - se la username è uguale a $_SESSION['auth']['username'] OK
     *
     *
     */


?>
