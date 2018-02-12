<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
// $_GET[id] id prodotto//

$main = new Template("dtml/shop/frame-public.html");

$body = new Template("dtml/shop/prodotto.html");
require "include/credential.inc.php";




//Query info prodotto
$query="SELECT * FROM Products WHERE id='$_GET[id]';";
$result = $db->getResult_array($query);
//.Query

//Set info prodotto
$body->setContent("id_product",$_GET[id]);//set id prodotto per immagini
$body->setContent("name",$result[0]['Name']);//set descrizione
$body->setContent("price",$result[0]['Price']);//set prezzo
$body->setContent("original_price",$result[0]['Price']+10);//set prezzo
$body->setContent("brand",$result[0]['Brand']);//set brand
$body->setContent("description",$result[0]['Description']);//set descrizione

//Query info categoria prodotto
$query="SELECT Category.Name FROM Products
        JOIN Category ON Products.id_Category=Category.id
        WHERE Products.id='$_GET[id]';";
$result = $db->getResult_array($query);
//.Query
//Set info categoria
$body->setContent("category",$result[0]['Name']);//set categoria

//Query info catalogo prodotto
$query="SELECT Catalogs.Type FROM Products
        JOIN Catalogs ON Products.id_Catalogs=Catalogs.id
        WHERE Products.id='$_GET[id]';";
$result = $db->getResult_array($query);
//.Query
//Set info categoria
$body->setContent("catalog",$result[0]['Type']);//set categoria

$main->setContent("css", "cssprodotto");//set css
$main->setContent("js", "jsprodotto");//set js
$main->setContent("body", $body->get());
$main->close();
