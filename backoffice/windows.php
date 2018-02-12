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
  case 'list':   // Report windows
    $body = new Template("dtml/lumino/html/windows/windows_list.html"); //TEMPLATE
    $body->setContent("top", ["Windows","Windows List"]);//ADDRESS
    $body->setContent("title","Windows List"); //TITLE

    //Query report
    $query="SELECT * FROM Windows";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("data", $result); // SET REPORT

  break;

  case 'insert':   // insert windows
    $body = new Template("dtml/lumino/html/windows/windows_form.html");//TEMPLATE
    $body->setContent("top", ["Windows","Insert Windows"]); //ADDRESS
    $body->setContent("title","Insert Windows"); //TITLE
    $body->setContent("submit"," Insert Windows"); //BUTTOM

    //save insert
    if (isset($_POST['name'])){
        //Query inserimento
        $query="INSERT INTO Windows (`Name`,`Description`)
          VALUES('{$_POST['name']}',
                 '{$_POST['description']}')";
        $result = $db->query($query);
        //.Query

        $body->setContent("notification", $result); // SET NOTIFICA
    }
  break;

  case 'delete':   // delete windows AND UPDATE!
      //Query delete
      $query="DELETE FROM Windows WHERE id='{$_GET['id']}'";
      $result = $db->query($query);
      //.Query

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

  case 'images':
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
          WHERE id_Windows='{$_GET['id']}'";
  $result = $db->getResult_array($query);
  //.Query

  $body->setContent("images", $result); // SET REPORT

  break;

}//.switch
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
