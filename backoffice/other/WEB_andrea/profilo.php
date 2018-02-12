<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
$main = new Template("dtml/shop/frame-public.html");
$body = new Template("dtml/shop/profilo.html");
require "include/credential.inc.php";

$main->setContent("css", "cssprofilo");
$main->setContent("js", "jsprofilo");

if(!isset($_REQUEST['page'])){

  $_REQUEST['page'] = 'informazioni';
}else{

switch ($_REQUEST['page']) {


  case 'informazioni':

  //query
  $query="SELECT Username, Email, Name, Surname, Address, City FROM Users
            JOIN CustumerList ON Users.id_CustumerList = CustumerList.id;";
  $result = $db->getResult_array($query);
  $body->setContent("info", $result);
  //query


  $body->setContent("activeInformazioniUtente", "active");
  $body->setContent("fafaInformazioniUtente", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;



  case 'modifica':

    //query
    $query="SELECT * FROM Users
              JOIN CustumerList ON Users.id_CustumerList = CustumerList.id
              WHERE Username='andcant';";
    $result = $db->getResult_array($query);
    $body->setContent("edit", $result);
    //query


  $body->setContent("activeModificaAccount", "active");
  $body->setContent("fafaModifica Account", "class=\"fa fa-angle-double-right\" aria-hidden=\"true\"");
  break;


}

}       //<span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>

$main->setContent("body", $body->get());

$main->close();
