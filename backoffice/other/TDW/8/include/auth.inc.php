<?php

    session_start();

    if ((!isset($_POST['username'])) AND (!isset($_POST['password']))) {

        if (!isset($_SESSION['auth'])) {
            // non è in sessione

            Header("Location: error.php?id=1002");
            exit;
        }

    } else {


        $result = $db->getResult("SELECT * FROM users
                                   WHERE username = '{$_POST['username']}'
                                     AND password = MD5('{$_POST['password']}')");

        if (!$result) {
            Header("Location: error.php?id=1001");
            exit;
        }
        
        $_SESSION['auth'] = $result[0];

    }





?>
