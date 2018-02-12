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

  case 'delete':   // delete windows AND UPDATE!
      //Query delete
      $query="DELETE FROM Images WHERE id='{$_GET['imm']}'";
      $result = $db->query($query);
      Header("Location: windows.php");exit;
      //.Query

  case 'list':
  $body = new Template("dtml/lumino/html/banner/banner_list.html"); //TEMPLATE
  $body->setContent("top", ["Windows","Windows List","Images Window"]); //ADDRESS

  //TITLE
  //Query report
  $query="SELECT Name FROM Windows
          WHERE id='{$_GET['id']}'";
  $result = $db->getResult_array($query);
  //.Query

  $body->setContent("title",$result[0]['Name']); // SET TITLE
  //.TITLE

  //Query report
  $query="SELECT id_Images as Images, Name FROM Images_Windows
          WHERE id_Windows='{$_GET['id']}';";
  $result = $db->getResult_array($query);
  //.Query

  $body->setContent("windows", $_GET['id']); // SET WINDOW
  $body->setContent("images", $result); // SET REPORT
  break;

  case 'insert':   // insert banner
    $body = new Template("dtml/lumino/html/banner/banner_form.html");//TEMPLATE
    $body->setContent("top", ["Windows","Windows List","Images Window","Image"]); //ADDRESS
    $body->setContent("title","Insert banner"); //TITLE

    // richiesta inserimento
    if(isset($_POST['name'])){   	// se ci sono stati problemi nell'upload del file
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
      				Image = '$dati_file'
              ";
        $result = $db->query($query);
        //.query

        //recupero id immagine inserita
        $query = "SELECT max(id) as id FROM Images";
        $result = $db->getResult_array($query);
        //.query

        //Query inserimento
        $query="INSERT INTO Images_Windows SET
                id_Images = '{$result[0]['id']}',
                id_Windows = '{$_POST['id']}',
                Name = '{$_POST['name']}'
                ;";
        $result = $db->query($query);
        //.Query

        $body->setContent("notification", $result); // SET NOTIFICA

      }//.else
    }//.if


    $body->setContent("id", $_GET['id']);


  break;



  case 'update':   // report update
    $body = new Template("dtml/lumino/html/windows/windows_list.html"); //TEMPLATE
    $body->setContent("top", ["Windows","Windows List"]); //ADDRESS
    $body->setContent("title","Windows List"); //TITLE

    //Query report update
    $query="SELECT id,Name FROM Windows;";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("report_update", $result); // SET REPORT UPDATE

  break;

  case 'edit':   // edit windows

    $body = new Template("dtml/lumino/html/windows/windows_form.html"); //TEMPLATE
    $body->setContent("top", ["Windows","Edit Windows"]); //ADDRESS
    $body->setContent("title","Edit Windows"); //TITLE
    $body->setContent("submit"," Save Windows"); //BUTTOM

    // Update
    if (isset($_POST['name'])){
      //Query update
      $query="UPDATE Windows SET
                name ='{$_POST['name']}',
                description ='{$_POST['description']}'
                WHERE id='{$_POST['id']}';";
      $result = $db->query($query);
      //.Query

      $body->setContent("notification", $result); // SET NOTIFICATION
    }

    $query="SELECT * FROM Windows WHERE id='{$_GET['id']}'";
    $result = $db->getResult_array($query);

    //placeholder
    $body->setContent("id", $result[0][0]);
    $body->setContent("name", $result[0][1]);
    $body->setContent("description", $result[0][2]);

  break;


  case 'view':
  $body = new Template("dtml/lumino/html/gallery/image.html"); //TEMPLATE
  $body->setContent("top", ["Windows","Windows List","Images Window","Image"]); //ADDRESS

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
  $body->setContent("id","{$_GET['id']}");  //set id
  $body->setContent("place",$result[0]['Place']); //set place
  $body->setContent("image","{$_GET['id']}"); //set immagine

  break;

}//.switch
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
