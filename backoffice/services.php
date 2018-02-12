<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/lumino/html/frame-public.html");

if (!isset($_REQUEST['page'])) {
    $_REQUEST['page'] = 'list';
}

switch ($_REQUEST['page']) {
  case 'list':   // REPORT
    $body = new Template("dtml/lumino/html/services/services_list.html");
    $body->setContent("top", ["Services","Service List"]);
    $body->setContent("title","Service List");

    //query report
    $query="SELECT * FROM  Services;";
    $result = $db->getResult_array($query);
    //.query

    $body->setContent("data", $result);

  break;

  case 'insert':   // INSERT SERVICE
    $body = new Template("dtml/lumino/html/services/services_form.html");
    $body->setContent("top", ["Services","Insert Service"]);
    $body->setContent("title","Insert Service");
    $body->setContent("submit"," Insert Service");

      if (isset($_POST['name'])){
        $query="INSERT INTO `Services`(`Name`,`Avaible`,`Description`)
                VALUES(
                  '{$_POST['name']}',
                  '{$_POST['avaible']}',
                  '{$_POST['description']}');";

        $result = $db->query($query);
        $body->setContent("notification", $result);
      }

  break;

  case 'delete':
    //query
    $query="DELETE FROM  services WHERE id='{$_GET['id']}';";
    $result = $db->query($query);
    //query.
  case 'update': //UPDATE SERVICE
    $body = new Template("dtml/lumino/html/services/services_list.html");
    $body->setContent("top", ["Services","Update Service"]);
    $body->setContent("title","Update Service");

    //query
    $query="SELECT Id,Name FROM  Services;";
    $result = $db->getResult_array($query);
    //query.

    $body->setContent("report_update", $result);
  break;

  case 'edit': //EDIT SERVICE
    $body = new Template("dtml/lumino/html/services/services_form.html");
    $body->setContent("top", ["Services","Edit Service"]);
    $body->setContent("title","Edit Service");
    $body->setContent("submit"," Save Service ");

    if (isset($_POST['name'])){
      //query -aggiornamento dati
        $query="UPDATE Services SET
                  name ='{$_POST['name']}',
                  avaible ='{$_POST['avaible']}',
                  description ='{$_POST['description']}'
                  WHERE id='{$_POST['id']}';";
        $result = $db->query($query);
        //query.
        $body->setContent("notification", $result);
      }

    //query -recupero dati
    $query="SELECT * FROM  Services
            WHERE id='{$_REQUEST['id']}';";
    $result = $db->getResult_array($query);
    //query.

    //Caricamento dati
    $body->setContent("id",$result[0]['id']);
    $body->setContent("name",$result[0]['Name']);
    switch ($result[0]['Avaible']) {
      case 'Yes': $body->setContent("checkYes", "checked");
      break;
      case 'No': $body->setContent("checkNo", "checked");
      break;
    }
    $body->setContent("description",$result[0]['Description']);

}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
