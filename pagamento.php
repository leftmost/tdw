<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";

//pagamento effettuato
if(isset($_GET['cardNumber'])){

  //Query ordine completato
  $query="UPDATE Orders
          SET id_Status = '3'
          WHERE id='{$_GET['id']}';";
  $result = $db->query($query);

  //reindirizza ad acquisti
  Header("Location: profilo.php?page=acquisti");
}else{

$main = new Template("dtml/shop/Pagamento/pagamento.html");

$main->setContent("order",$_GET['order']);//set order

$main->close();
}
