<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/lumino/html/frame-public.html");

//default page
if (!isset($_REQUEST['page'])){
  $_REQUEST['page'] = 'list';
}

switch ($_REQUEST['page']) {

  case 'list':
  $body = new Template("dtml/lumino/html/gallery/gallery_list.html"); //TEMPLATE
  $body->setContent("top", ["Product","Product List","Images Product"]); //ADDRESS

  //TITLE
  //Query report
  $query="SELECT Name FROM Products
          WHERE id='{$_GET['id']}'";
  $result = $db->getResult_array($query);
  //.Query

  $body->setContent("title",$result[0]['Name']); // SET TITLE
  //.TITLE

  //Query report
  $query="SELECT id as Images, Name, Place FROM Images
          WHERE Product_idProduct='{$_GET['id']}';";
  $result = $db->getResult_array($query);
  //.Query
  $body->setContent("images", $result); // SET REPORT

  $body->setContent("id", $_GET['id']); // SET ID PRODUCT

  break;

  case 'insert':   // insert banner

  	if(!isset($_FILES['file_inviato']) OR $_FILES['file_inviato']['error'] != UPLOAD_ERR_OK){
  	$body->setContent("notification", "No file selected!");
    }else{

    	// recupero informazioni sul file inviato
    	$temp = $_FILES['file_inviato']['tmp_name'];
    	$name = $_FILES['file_inviato']['name'];
    	$type = $_FILES['file_inviato']['type'];
      $size = $_FILES['file_inviato']['size'];

    	// leggo il contenuto del file
    	$dati_file = file_get_contents($temp);

    	// preparo il contenuto del file per la query
    	$dati_file = addslashes($dati_file);

      // query per inserire il file nel DB
    	$query = "INSERT INTO Images SET
    				Name = '$name',
    				Type = '$type',
            Size = '$size',
    				Image = '$dati_file',
            Product_idProduct = '{$_POST['id']}' ";
      $result = $db->query($query);
      //.query


    }//.else

    Header("Location: gallery.php?page=list&id={$_POST['id']}");
    exit;
  break;

  case 'delete':   // delete windows AND UPDATE!
  //recupero id prodotto
  $query="SELECT Product_idProduct as id FROM Images WHERE id='{$_GET['id']}'";
  $product = $db->getResult_array($query);
  //.Query

      //Query delete
      $query="DELETE FROM Images WHERE id='{$_GET['id']}'";
      $result = $db->query($query);
      //.Query

      Header("Location: gallery.php?page=list&id={$product[0]['id']}");
  break;

  case 'view':
  $body = new Template("dtml/lumino/html/gallery/image.html"); //TEMPLATE
  $body->setContent("top", ["Product","Product List","Images Product","Image"]); //ADDRESS

  // richiesta di modifica con submit
  if(isset($_POST['id'])){
  	// se ci sono stati problemi nell'upload del file
  	if(!isset($_FILES['file_inviato']) OR $_FILES['file_inviato']['error'] != UPLOAD_ERR_OK){
  	$body->setContent("notification", "No file selected!");
    }else{

    	// recupero informazioni sul file inviato
    	$temp = $_FILES['file_inviato']['tmp_name'];
    	$name = $_FILES['file_inviato']['name'];
    	$type = $_FILES['file_inviato']['type'];
      $size = $_FILES['file_inviato']['size'];

    	// leggo il contenuto del file
    	$dati_file = file_get_contents($temp);

    	// preparo il contenuto del file per la query
    	$dati_file = addslashes($dati_file);

      // query per inserire il file nel DB
    	$query = "UPDATE Images SET
    				Name = '$name',
    				Type = '$type',
            Size = '$size',
    				Image = '$dati_file'
            WHERE id={$_POST['id']}";
      $result = $db->query($query);
      $body->setContent("notification", $result); // SET NOTIFICATION
      //.query
    }//.else
  }//.if


  // recupero dati immagine
  $query="SELECT Name,Type,Size,Place FROM Images
          WHERE id='{$_GET['id']}'";
  $result = $db->getResult_array($query);

  $body->setContent("title",$result[0]['Name']);  // set nome
  $body->setContent("type",$result[0]['Type']); //set tipo
  $body->setContent("size",$result[0]['Size']); //set size
  $body->setContent("place",$result[0]['Place']); //set place
  $body->setContent("id","{$_GET['id']}");  //set id
  $body->setContent("image","{$_GET['id']}"); //set immagine


  break;

}//.switch
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
