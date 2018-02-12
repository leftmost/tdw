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
  case 'list':   // Report status
    $body = new Template("dtml/lumino/html/status/status_list.html"); //TEMPLATE
    $body->setContent("top", ["Status","Status List"]);//ADDRESS
    $body->setContent("title","Status List"); //TITLE

    //Query report
    $query="SELECT * FROM Status";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("data", $result); // SET REPORT

  break;

  case 'insert':   // insert status
    $body = new Template("dtml/lumino/html/status/status_form.html");//TEMPLATE
    $body->setContent("top", ["Status","Insert Status"]); //ADDRESS
    $body->setContent("title","Insert Status"); //TITLE
    $body->setContent("submit"," Insert Status"); //BUTTOM

    //save insert
    if (isset($_POST['name'])){
        //Query inserimento
        $query="INSERT INTO Status (`Name`,`Description`)
          VALUES('{$_POST['name']}',
                 '{$_POST['description']}')";
        $result = $db->query($query);
        //.Query

        $body->setContent("notification", $result); // SET NOTIFICA
    }
  break;

  case 'delete':   // delete status AND UPDATE!
      //Query delete
      $query="DELETE FROM Status WHERE id='{$_GET['id']}'";
      $result = $db->query($query);
      //.Query

  case 'update':   // report update
    $body = new Template("dtml/lumino/html/status/status_list.html"); //TEMPLATE
    $body->setContent("top", ["Status","Status List"]); //ADDRESS
    $body->setContent("title","Status List"); //TITLE

    //Query report update
    $query="SELECT id,Name FROM Status;";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("report_update", $result); // SET REPORT UPDATE

  break;

  case 'edit':   // edit status

    $body = new Template("dtml/lumino/html/status/status_form.html"); //TEMPLATE
    $body->setContent("top", ["Status","Edit Status"]); //ADDRESS
    $body->setContent("title","Edit Status"); //TITLE
    $body->setContent("submit"," Save Status"); //BUTTOM

    // Update
    if (isset($_POST['name'])){
      //Query update
      $query="UPDATE Status SET
                name ='{$_POST['name']}',
                description ='{$_POST['description']}'
                WHERE id='{$_POST['id']}';";
      $result = $db->query($query);
      //.Query

      $body->setContent("notification", $result); // SET NOTIFICATION
    }

    $query="SELECT * FROM Status WHERE id='{$_GET['id']}'";
    $result = $db->getResult_array($query);

    //placeholder
    $body->setContent("id", $result[0][0]);
    $body->setContent("name", $result[0][1]);
    $body->setContent("description", $result[0][2]);

  break;

}//.switch
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
