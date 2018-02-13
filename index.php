<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/home.html");
require "include/credential.inc.php"; //frame public secondo la login
$main->setContent("css", "cssindex");
$main->setContent("js", "jsindex");
//query ULTIMI ARRIVI DONNA
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct
        JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
        WHERE Catalogs.Type='Women'
        AND Images.Place='1'
        LIMIT 5;";
$result = $db->getResult_array($query);
$body->setContent("prodottoWoman", $result);
//query
//query ULTIMI ARRIVI UOMO
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct
        JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
        WHERE Catalogs.Type='Men'
        AND Images.Place='1'
        LIMIT 5;";
$result = $db->getResult_array($query);
$body->setContent("prodottoMen", $result);
//query
//query ULTIMI ARRIVI BAMBINI
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct
        JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
        WHERE Catalogs.Type='Kids'
        AND Images.Place='1'
        LIMIT 5;";
$result = $db->getResult_array($query);
$body->setContent("prodottoKid", $result);
//query
//query BEST SELLERS
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct
        AND Images.Place='1'
        LIMIT 5;";
$result = $db->getResult_array($query);
$body->setContent("bestsellers", $result);
//query
$main->setContent("body", $body->get());
$main->close();