<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";

$main = new Template("dtml/nevia/frame-public.html");

if (!isset($_REQUEST['step'])) {
  $_REQUEST['step'] = 0;
}


switch ($_REQUEST['step']) {
  case 0:   // report
  echo "report";
  $body = new Template("dtml/nevia/users-update.html");

  $result = $db->getResult_array("SELECT id, name, surname FROM users_old");

  $body->setContent("data", $result);
  break;

  case 1:   // modifica
  echo "modifica";

  $body = new Template("dtml/nevia/users-modifica.html");

  $id=$_GET['key'];

  $result = $db->getResult_array("SELECT name, surname FROM users_old where id=$id;");

  $body->setContent("id", $id);
  $body->setContent("name", $result[0]['name']);
  $body->setContent("surname", $result[0]['surname']);

  break;

  case 2: //delete
  echo "delete";
    $body = new Template("dtml/nevia/users-update.html");

    $sql='delete from users_old where id='."{$_GET['key']}";
    $db->query($sql);

    $result = $db->getResult_array("SELECT id, name, surname FROM users_old");

    $body->setContent("data", $result);

    break;

  case 3: //save

  echo "salva";
  $body = new Template("dtml/nevia/users-modifica.html");

  $id=$_POST['id'];
  $name=$_POST['name'];
  $surname=$_POST['surname'];

  echo "$name";

  $query= "UPDATE users_old SET name ='$name',surname ='$surname' WHERE id =$id";
  $result = $db->query($query);
  $body->setContent("notification", 1);
  echo $query;

  $result = $db->getResult_array("SELECT name, surname FROM users_old where id=$id;");

  $body->setContent("id", $id);
  $body->setContent("name", $name);
  $body->setContent("surname", $surname);









  break;

}



$main->SetContent("body", $body->get());
$main->close();

?>
