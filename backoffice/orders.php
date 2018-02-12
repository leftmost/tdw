<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/lumino/html/frame-public.html");

if (!isset($_REQUEST['page'])) {
  $_REQUEST['page'] = 'list';
}

switch ($_REQUEST['page']) {
  case 'list':   // report
  $body = new Template("dtml/lumino/html/orders/orders_list.html"); //TEMPLATE
  $body->setContent("top", ["Orders","Orders List"]); // ADDRESS
  $body->setContent("title","Orders List"); // TITLE

  //query report
  $query="SELECT Orders.id,Orders.CreationDate as Date,Orders.Username_Users as User,Status.Name as Status
          FROM Orders
          JOIN Status ON Orders.id_Status=Status.id;";
  $result = $db->getResult_array($query);
  //.query

  $body->setContent("data", $result); //SET REPORT

  break;

  case 'insert':   // insert product
    $body = new Template("dtml/lumino/html/products/products_form.html"); //TEMPLATE
    $body->setContent("top", ["Products","Insert Product"]); // ADDRESS
    $body->setContent("title","INSERT NEW PRODUCT"); // TITLE
    $body->setContent("submit"," Insert Product"); // BUTTOM

    //Query load option Category
    $query="SELECT id,Name FROM Category;";
    $result = $db->getResult_array($query);
    $body->setContent("optionCategory", array($result,""));
    //.Query

    //Query load option Catalogs
    $query="SELECT id,Name FROM Catalogs;";
    $result = $db->getResult_array($query);
    $body->setContent("optionCatalogs", array($result,""));
    //.Query

    //Query load option Warehouse
    $query="SELECT Area FROM Warehouse GROUP BY Area;";
    $result = $db->getResult_array($query);
    $body->setContent("optionWarehouse", array($result,""));
    //.Query

    // Submit values insert
    if (isset($_POST['name'])){

      //Query insert product
      $query="INSERT INTO Products (`Name`,`Brand`,`Price`,`id_Category`,`id_Catalogs`,`Description`)
      VALUES('{$_POST['name']}',
        '{$_POST['brand']}',
        '{$_POST['price']}',
        '{$_POST['category']}',
        '{$_POST['catalog']}',
        '{$_POST['description']}')";
      $result = $db->query($query);
      //.Query

      //load product id
      $query="SELECT max(id) as id FROM Products";
      $result = $db->getResult_array($query);
      //.Query

      //Query insert product into warehouse with id
      $query="INSERT INTO Products_Warehouse SET
              id_Products='{$result[0]['id']}',
              Area_Warehouse='{$_POST['warehouse']}',
              Sector_Warehouse='{$_POST['sector']}',
              Amount='{$_POST['amount']}';";
      $result = $db->query($query);
      //.Query

      $body->setContent("notification", $result); // SET NOTIFICATION
    }

  break;

  case 'delete':   // delete product of order

    //query delete
    $query="DELETE FROM Orders_Product WHERE Order_id='{$_GET['id_Order']}' AND Product_id='{$_GET['id_Product']}'";
    $result = $db->query($query);
    //.query

    Header("Location: orders.php?page=view&id={$_GET['id_Order']}");
    break;

    case 'deleteOrder':   // delete product of order

      //query delete
      $query="DELETE FROM Orders WHERE id='{$_GET['id']}'";
      $result = $db->query($query);
      //.query

      Header("Location: orders.php?page=list");
      break;

    case 'edit':   // report

    $body = new Template("dtml/lumino/html/orders/orders_edit.html"); //TEMPLATE
    $body->setContent("top", ["Orders","Orders List","Order: {$_GET['id_Order']}"]); // ADDRESS
    $body->setContent("title","ID: {$_GET['id_Order']}"); // TITLE
    $body->setContent("submit"," Save Order"); //BUTTOM

    // Submit values update
    if (isset($_POST['id_Product'])){

      //Query update values:name,price,brand,category and description
      $query="UPDATE Orders_Product SET
      Product_id ='{$_POST['id_Product']}',
      Amount ='{$_POST['amount']}'
      WHERE Order_id ='{$_POST['OLD_id_Order']}'
      AND Product_id='{$_POST['OLD_id_Product']}';";

      $result = $db->query($query);
      //.Query PRODOTTO

      $body->setContent("notification", $result); // SET NOTIFICATION
    }//.submit values

    //Query load order
    $query="SELECT *
            FROM Orders_Product
            WHERE Order_id='{$_GET['id_Order']}';";
    $order = $db->getResult_array($query);
    //.Query



    $body->setContent("id_Order", $order[0]['Order_id']); //SET ID ORDER
    $body->setContent("id_Product", $order[0]['Product_id']); //SET ID PRODUCT
    $body->setContent("amount", $order[0]['Amount']); //SET AMOUNT


    break;

  case 'view':   // warehouse list
    $body = new Template("dtml/lumino/html/orders/orders_list.html"); //TEMPLATE
    $body->setContent("top", ["Orders","Orders List","Order: {$_GET['id']}"]); // ADDRESS
    $body->setContent("title","ID: {$_GET['id']}"); // TITLE

    //Query load correct warehouse
    $query="SELECT Order_id as 'ID Order', Product_id as 'ID Product', Amount
            FROM Orders_Product
            WHERE Order_id='{$_GET['id']}';";
    $result = $db->getResult_array($query);
    $body->setContent("report_update", $result);
    //.Query

  break;
  }
  $main->setContent("username",$_SESSION['auth']['Username']);
  $main->setContent("body", $body->get());
  $main->close();
