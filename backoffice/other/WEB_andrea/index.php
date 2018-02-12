<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";

$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/home.html");

require "include/credential.inc.php";

$main->setContent("css", "cssindex");
$main->setContent("js", "jsindex");

//query ULTIMI ARRIVI
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct;";
$result = $db->getResult_array($query);
$body->setContent("prodotto", $result);
//query

//query BEST SELLERS
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct;";
$result = $db->getResult_array($query);
$body->setContent("bestsellers", $result);
//query






$main->setContent("body", $body->get());

$main->close();
