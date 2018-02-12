<?php
require "include/template2.inc.php";


$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/categorie.html");

require "include/credential.inc.php";

$main->setContent("css", "csscategorie");
$main->setContent("js", "jscategorie");



$main->setContent("body", $body->get());

$main->close();
