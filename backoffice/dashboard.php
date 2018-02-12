<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/lumino/html/frame-public.html");

$body = new Template("dtml/lumino/html/dashboard.html");


$body->setContent("username", $_SESSION['auth']['Username']);
$body->setContent("email", $_SESSION['auth']['Email']);
$body->setContent("password", $_SESSION['auth']['Password']);

//Query anagrafica
$query="SELECT * FROM CustumerList
        WHERE id='{$_SESSION['auth']['id_CustumerList']}';";
$result = $db->getResult_array($query);
//.Query
//set dati anagrafica
$body->setContent("name", $result[0]['Name']);
$body->setContent("surname", $result[0]['Surname']);
$body->setContent("address", $result[0]['Address']);
$body->setContent("city", $result[0]['City']);
//.anagrafica

//Query Gruppo
$query="SELECT * FROM Users_Groups
        WHERE Username_Users='{$_SESSION['auth']['Username']}'
        ORDER BY Name_Groups;";
$result = $db->getResult_array($query);
//.Query
//set Gruppo
$body->setContent("listGroup",$result);
//.Gruppo

//Query Servizi
$query="SELECT Services.Description as Name, Services.Avaible, Services_Groups.Actived
        FROM Users
        JOIN Users_Groups ON Users_Groups.Username_Users=Users.Username
        JOIN Services_Groups ON Services_Groups.Name_Groups=Users_Groups.Name_Groups
        JOIN Services ON Services_Groups.id_Service=Services.id
        WHERE Users.Username='{$_SESSION['auth']['Username']}' GROUP BY Services.id ORDER BY Services.Description;";
$result = $db->getResult_array($query);
//.Query
//set servizi
$body->setContent("data",$result);
//.Servizi

$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());

$main->close();
