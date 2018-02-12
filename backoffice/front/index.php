<?php
require "include/template2.inc.php";

$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/home.html");

$main->setContent("body", $body->get());

$main->close();
