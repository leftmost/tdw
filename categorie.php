<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/categorie.html");

require "include/credential.inc.php"; //frame public secondo la login

$main->setContent("css", "csscategorie");
$main->setContent("js", "jscategorie");

$body->setContent("type",$_GET['type']);//set barra navigazione uomo
$body->setContent("activeType", "active");//evidenzia uomo

//query inserimento categorie barra laterale
$query="SELECT id,Name FROM Category;";
$result = $db->getResult_array($query);
$body->setContent("categorie", array($result,"{$_GET['type']}"));
//.query

//richiesta di specifica categoria
if(isset($_GET['page'])){
  //mostra prodotti uomo della categoria
  $query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place FROM Products
          JOIN Images ON Products.id = Images.Product_idProduct
          JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
          WHERE Images.Place='1'
          AND Catalogs.Type='{$_GET['type']}'
          AND Products.id_Category={$_GET['page']};";
  $result = $db->getResult_array($query);
  $body->setContent("prodottoMen", $result);//set prodotti uomo

}else{

  //query mostra tutti i prodotti
  $query="SELECT Products.id,Products.Name,Price,Images.id as idImage,Images.Place FROM Products
          JOIN Images ON Products.id = Images.Product_idProduct
          JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
          WHERE Images.Place='1'
          AND Catalogs.Type='{$_GET['type']}';";
  $result = $db->getResult_array($query);
  $body->setContent("prodottoMen", $result);//set prodotti uomo
  //query

}






$main->setContent("body", $body->get());

$main->close();
