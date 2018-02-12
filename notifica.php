<?php

require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
$date = date('Y/m/d');

if (isset($_POST['id'])){
  if(!isset($_SESSION['auth']['Username'])){
    exit;
  }

  //query numero elementi nel carrello
  $query="SELECT SUM(Amount)  AS numero FROM Orders
          JOIN orders_product ON orders_product.Order_id=orders.id
          WHERE Orders.id_Status=2 AND Orders.Username_Users='{$_SESSION['auth']['Username']}';";
  $result = $db->getResult_array($query);
  //print_r($result[0]['numero']) ;;exit;
  //query

  if(empty($result[0]['numero'])){
  }else{

    echo "<span id=\"checkout_items\" class=\"checkout_items\">{$result[0]['numero']}</span>";

  }
}
