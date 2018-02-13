<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/profilo.html");
require "include/credential.inc.php";

if(!isset($_SESSION['auth'])){
  header("location: login.php");
}

$main->setContent("css", "cssprofilo");
$main->setContent("js", "jsprofilo");

if(!isset($_REQUEST['page'])){

  $_REQUEST['page'] = 'informazioni';
}else{

switch ($_REQUEST['page']) {


  case 'informazioni':

  $query="SELECT Username, Email, Name, Surname, Address, City
          FROM Users
          JOIN CustumerList ON Users.id_CustumerList = CustumerList.id
          WHERE Users.id_CustumerList ='{$_SESSION['auth']['id_CustumerList']}';";


  $result = $db->getResult_array($query);
  //print_r($result);exit;
  $body->setContent("info", $result);
  //query


  $body->setContent("activeInformazioniUtente", "active");
  $body->setContent("fafaInformazioniUtente", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;



  case 'modifica':



    if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){

      if($_POST['email'] !="" && $_POST['username'] !="" && $_POST['password'] !=""){

        $query="UPDATE Users
                INNER JOIN CustumerList ON Users.id_CustumerList = CustumerList.id
                SET Username = '{$_POST['username']}',
                    Email = '{$_POST['email']}',
                    Password = '{$_POST['password']}',
                    Name = '{$_POST['name']}',
                    Surname = '{$_POST['surname']}',
                    Address = '{$_POST['address']}',
                    City = '{$_POST['city']}'
                WHERE Users.id_CustumerList ='{$_SESSION['auth']['id_CustumerList']}';";

        $result = $db->query($query);

      }//.if
    }

    //query
    $query="SELECT * FROM Users
              JOIN CustumerList ON Users.id_CustumerList = CustumerList.id
              WHERE Users.id_CustumerList ='{$_SESSION['auth']['id_CustumerList']}';";
    $result = $db->getResult_array($query);
    $body->setContent("edit", $result);
    //query


  $body->setContent("activeModificaAccount", "active");
  $body->setContent("fafaModifica Account", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;

  case 'delete':
  //query
  $query="SELECT Orders.id FROM Orders
          JOIN Users ON Orders.Username_Users='{$_SESSION['auth']['Username']}'
          JOIN Status ON Orders.id_Status=2
          GROUP BY Orders.id;";
  $result = $db->getResult_array($query);
  $order=$result[0]['id'];
  //query

  //query
  $size=$_GET['size'];
  $prod=$_GET['id'];
  $amount=$_GET['amount'];
  //echo $amount;exit;
  if($amount>1){

    $query="UPDATE Orders_Product
            SET Amount=Amount-1
            WHERE Order_id='$order'
            AND Product_id='$prod'
            AND Size='$size';";
    $result = $db->query($query);

  }else{

    //delete
    $query="DELETE FROM Orders_Product 
            WHERE Order_id='$order'
            AND Product_id='$prod'
            AND Size='$size';";
    
    $result = $db->query($query);
    //header("location:/profilo.php?page=carrello");
    //break;

  }


    //riposiziona nel magazzino
  $query="UPDATE products_warehouse
            SET Amount=Amount+1
            WHERE id_products='$prod'
            AND Size='$size';";
  $result = $db->query($query);



  case 'carrello':
  //query
  $query="SELECT Orders.id FROM Orders
          JOIN Users ON Orders.Username_Users='{$_SESSION['auth']['Username']}'
          JOIN Status ON Orders.id_Status=2
          GROUP BY Orders.id;";
  $result = $db->getResult_array($query);
  $order=$result[0]['id'];
  //query

  //query
  $query="SELECT Products.id,Products.Name,Products.Brand,Products.Price, Orders_Product.Amount, Orders_Product.Size
          FROM Orders_Product
          JOIN Products ON Orders_Product.Product_id=Products.id
          WHERE Orders_Product.Order_id='$order';";
  $result = $db->getResult_array($query);
  //query
  $body->setContent("carrello",$result);

  if(!empty($result)){
    //inserisci pulsante acquista se ci sono articoli
    //query
    $body->setContent("buy",$order);
  }


  $body->setContent("activeCarrello", "active");
  $body->setContent("fafaCarrello", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;

  case 'acquisti':
  //query

  $query="SELECT Products.Name,Products.Price,Products.Brand,Orders_Product.Amount,Orders_Product.Size from Orders
          JOIN Orders_Product ON Orders.id=Orders_Product.Order_id
          JOIN Products ON Orders_Product.Product_id=Products.id
          WHERE Orders.id_Status='3'
          AND Orders.Username_Users='{$_SESSION['auth']['Username']}';";
  $result = $db->getResult_array($query);
  //query

  $body->setContent("acquisti",$result);

  $body->setContent("activeAquistiEffettuati", "active");
  $body->setContent("fafaAquistiEffettuati", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;
}

}       //<span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>

$main->setContent("body", $body->get());

$main->close();
