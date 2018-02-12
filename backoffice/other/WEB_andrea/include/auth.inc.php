<?php

session_start();

if (!isset($_SESSION['auth'])) {
    // non è in sessione
    $page=$_SERVER['REQUEST_URI'];
    Header("Location: login.php?redirect=$page");
    exit;
}

$username=$_SESSION['auth']['Username'];
//la sessione esiste
//Query servizi attivi e disponibili
$query="SELECT Services.Name, Services.Avaible, Services_Groups.Actived
        FROM Users
        JOIN Users_Groups ON Users_Groups.Username_Users=Users.Username
        JOIN Services_Groups ON Services_Groups.Name_Groups=Users_Groups.Name_Groups
        JOIN Services ON Services_Groups.id_Service=Services.id
        WHERE Users.Username='$username' GROUP BY Services.id;";
$result = $db->getResult_array($query);

if(empty($result)){Header("Location: 401.html");exit;} // Utente base (non ha alcun permessso)

foreach($result as $row) {
    $permission[$row['Name']] = $row;
}

$_SESSION['auth']['services'] = $permission;
//controllo pagina
if (!isset($_SESSION['auth']['services'][basename($_SERVER['SCRIPT_NAME'])])) {

    /* utente non autorizzato */

    Header("Location: 401.html");
    exit;


}elseif ($_SESSION['auth']['services'][basename($_SERVER['SCRIPT_NAME'])]['Avaible'] == 'No') {

    /* script non attivo */

    Header("Location: 503.html");
    exit;

}
