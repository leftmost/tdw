<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";

$main = new Template("dtml/nevia/frame-public.html");


$body = new Template("dtml/nevia/users-update.html");

$sql='delete from users where id='."{$_GET['key']}";
$db->query($sql);

$result = $db->getResult_array("SELECT id, name, surname FROM users");

$body->setContent("data", $result);


$main->SetContent("body", $body->get());
$main->close();

?>
