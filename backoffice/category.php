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
  case 'list':   // Report category
    $body = new Template("dtml/lumino/html/category/category_list.html"); //TEMPLATE
    $body->setContent("top", ["Categories","Category List"]);//ADDRESS
    $body->setContent("title","Category List"); //TITLE

    //Query report
    $query="SELECT * FROM Category";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("data", $result); // SET REPORT

  break;

  case 'insert':   // insert category
    $body = new Template("dtml/lumino/html/category/category_form.html");//TEMPLATE
    $body->setContent("top", ["Category","Insert Category"]); //ADDRESS
    $body->setContent("title","Insert Category"); //TITLE
    $body->setContent("submit"," Insert Category"); //BUTTOM

    //save insert
    if (isset($_POST['name'])){
        //Query inserimento
        $query="INSERT INTO Category (`Name`,`Description`)
          VALUES('{$_POST['name']}',
                 '{$_POST['description']}')";
        $result = $db->query($query);
        //.Query

        $body->setContent("notification", $result); // SET NOTIFICA
    }
  break;

  case 'delete':   // delete category AND UPDATE!
      //Query delete
      $query="DELETE FROM Category WHERE id='{$_GET['id']}'";
      $result = $db->query($query);
      //.Query

  case 'update':   // report update
    $body = new Template("dtml/lumino/html/category/category_list.html"); //TEMPLATE
    $body->setContent("top", ["Category","Category List"]); //ADDRESS
    $body->setContent("title","Category List"); //TITLE

    //Query report update
    $query="SELECT id,Name FROM CATEGORY;";
    $result = $db->getResult_array($query);
    //.Query

    $body->setContent("report_update", $result); // SET REPORT UPDATE

  break;

  case 'edit':   // edit category

    $body = new Template("dtml/lumino/html/category/category_form.html"); //TEMPLATE
    $body->setContent("top", ["Categories","Edit Category"]); //ADDRESS
    $body->setContent("title","Edit Category"); //TITLE
    $body->setContent("submit"," Save Category"); //BUTTOM

    // Update
    if (isset($_POST['name'])){
      //Query update
      $query="UPDATE Category SET
                name ='{$_POST['name']}',
                description ='{$_POST['description']}'
                WHERE id='{$_POST['id']}';";
      $result = $db->query($query);
      //.Query

      $body->setContent("notification", $result); // SET NOTIFICATION
    }

    $query="SELECT * FROM Category WHERE id='{$_GET['id']}'";
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
