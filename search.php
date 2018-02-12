<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/categorie.html");

require "include/credential.inc.php"; //frame public secondo la login

$main->setContent("css", "csscategorie");
$main->setContent("js", "jscategorie");


//query inserimento categorie barra laterale
$query="SELECT id,Name FROM Category;";
$result = $db->getResult_array($query);
$body->setContent("categorie", array($result,"{$_GET['type']}"));
//.query

$ricerca = $_POST['ricerca'];


//query mostra tutti i prodotti
$query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place,Category.Name as Category,Category.Description  FROM Products
        JOIN Images ON Products.id = Images.Product_idProduct
        JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
        JOIN Category ON Products.id_Category=Category.id
        WHERE Images.Place='1'
        AND MATCH (Products.Name,Products.Description,Products.Brand) AGAINST ('$ricerca, $ricerca, $ricerca,$ricerca')
        OR MATCH (Catalogs.Description,Catalogs.Name,Catalogs.Type,Catalogs.Collection) AGAINST ('$ricerca, $ricerca')
        AND Images.Place='1'
        OR MATCH (Category.Description,Category.Name) AGAINST ('$ricerca, $ricerca')
        AND Images.Place='1';";
//.query
$result = $db->getResult_array($query);
$body->setContent("prodottoMen", $result);//set prodotti uomo
//query

$main->setContent("body", $body->get());

$main->close();
