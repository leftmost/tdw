<?php
require "include/dbms.inc.php";

//seleziona l'immagine numero n dal prodotto
if(isset($_GET['n'])){
  //id = id prodotto
  // n = numero immagine prodotto
  $query="SELECT * FROM Products
          JOIN Images ON Products.id = Images.Product_idProduct
          WHERE Products.id='{$_GET['id']}'";
  $result = $db->getResult_array($query);


  $img = $result[$_GET['n']]['Image'];
  header('Content-type: image/jpeg');
  echo $img;
  exit;
}

//seleziona l'immagine per id
// id = id immagine
$query="SELECT * FROM Images
        WHERE id='{$_GET['id']}'";
$result = $db->getResult_array($query);

$img = $result[0]['Image'];
header('Content-type: image/jpeg');
echo $img;
exit;
