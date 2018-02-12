<?php
require "include/template2.inc.php";


$main = new Template("dtml/shop/frame-public.html");

$body = new Template("dtml/shop/prodotto.html");
require "include/credential.inc.php";

$main->setContent("css", "cssprodotto");
$main->setContent("js", "jsprodotto");

$main->setContent("body", $body->get());

$main->close();
