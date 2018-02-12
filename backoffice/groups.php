<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/lumino/html/frame-public.html");

if (!isset($_REQUEST['page'])) {
    $_REQUEST['page'] = 'list';
}

switch ($_REQUEST['page']) {
  case 'list':   // Report con tutti i valori
    $body = new Template("dtml/lumino/html/groups/groups_list.html"); //TEMPLATE
    $body->setContent("top", ["Groups","Group List"]); //INDIRIZZO
    $body->setContent("title","Group List"); //TITOLO

    //query - recupero dati
    $query="SELECT * FROM Groups";
    $result = $db->getResult_array($query);
    //query.

    $body->setContent("data", $result); //TABELLA

  break;

  case 'insert':   // Inserimento di un gruppo
    $body = new Template("dtml/lumino/html/groups/groups_form.html");
    $body->setContent("top", ["Groups","Insert Group"]);
    $body->setContent("title","Insert Group");
    $body->setContent("submit"," Insert Group");

    //Utente invia dati per l'inserimento
    if (isset($_POST['name'])){

        //query - inserimento dati
        $query="INSERT INTO `groups` (`Name`,`Description`)
          VALUES('{$_POST['name']}',
                 '{$_POST['description']}')";
        $result = $db->query($query);
        //.query

        $body->setContent("notification", $result); //notifica
    }
  break;

  case 'delete':   // Eliminazione del gruppo e visualizzazione tabella
      //query - Delete
      $query="DELETE FROM Groups WHERE name='{$_GET['name']}'";
      $result = $db->query($query);
      //.query
  case 'update':   // Repord di modifica dati
    $body = new Template("dtml/lumino/html/groups/groups_list.html"); //TEMPLATE
    $body->setContent("top", ["Groups","Group Update"]); //INDIRIZZO
    $body->setContent("title","Group Update"); //TITOLO

    //query - Report
    $query="SELECT Name FROM Groups;";
    $result = $db->getResult_array($query);
    //.query
    $body->setContent("report_update", $result); //REPORT

  break;

  case 'edit':   // Modifica dati del gruppo

    $body = new Template("dtml/lumino/html/groups/groups_form.html");
    $body->setContent("top", ["Groups","Edit Group"]);
    $body->setContent("title","Edit Group");
    $body->setContent("submit"," Save Group");

    if (isset($_POST['name'])){
        //query - Aggironamento dati
        $query="UPDATE Groups SET
                  name ='{$_POST['name']}',
                  description ='{$_POST['description']}'
                  WHERE name='{$_POST['id']}';";
        $result = $db->query($query);
        //.query
        $body->setContent("notification", $result);//Notifica
    }

    //query - Recupero dati
    $query="SELECT * FROM Groups WHERE name='{$_REQUEST['name']}'";
    $result = $db->getResult_array($query);
    //.query

    //Compilazione campi
    $body->setContent("id", $result[0]['Name']);
    $body->setContent("name", $result[0]['Name']);
    $body->setContent("description", $result[0]['Description']);

  break;


    case 'services':   // AVAIBLE SERVICES

      $body = new Template("dtml/lumino/html/groups/groups_services.html");
      $body->setContent("top", ["Groups","Groups List","Group Services"]);
      $body->setContent("title","$_GET[name]");

      if(isset($_POST['form'])){
        $query="DELETE FROM Services_Groups WHERE Name_Groups='$_GET[name]';";
        $result = $db->query($query);
        if(isset($_POST['services'])){
          foreach ($_POST['services'] as $key => $value) {
            //query - inserimento dati
            $query="INSERT INTO `Services_Groups` (`id_Service`,`Name_Groups`,`Actived`)
              VALUES('$value',
                     '$_GET[name]',
                     'Yes')";
            $result = $db->query($query);
            //.query
            $body->setContent("notification", $result); //notifica
          }
        }
      }
      //query blocked
      $query="SELECT Services.id, Services.Description
              FROM Services
              WHERE Avaible='No';";
      $script = $db->getResult_array($query);
      //query blocked
      $body->setContent("blocked", $script);

      //query
      $query="SELECT Services.id, Services.Description
              FROM Groups
              JOIN Services_Groups ON Groups.Name = Services_Groups.Name_Groups
              JOIN Services ON Services_Groups.id_Service = Services.id
              WHERE Groups.Name='{$_GET['name']}'
              AND Actived='Yes';";
      $result = $db->getResult_array($query);

      //funzione rimozione
      foreach ($result as $keys => $values) {
        foreach ($script as $key => $value) {
          if($value[0]==$values[0]){unset($result[$keys]);}
        }
      }
      //query checked
      $body->setContent("checked", $result);

      //query
      $query="SELECT Services.id, Services.Description
              FROM Services
              WHERE Avaible='Yes';";
      $script = $db->getResult_array($query);

      //funzione rimozione
      foreach ($script as $keys => $values) {
        foreach ($result as $key => $value) {
          if($value[0]==$values[0]){unset($script[$keys]);}
        }
      }

      //query unchecked
      $body->setContent("unchecked", $script);



    break;
}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
