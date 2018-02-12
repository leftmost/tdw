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
        $body = new Template("dtml/lumino/html/warehouse/warehouse_list.html");
        $body->setContent("top", ["Warehouse","Warehouse List"]);
        $body->setContent("title", "Warehouse List");

        $query="SELECT * FROM Warehouse;";
        $result = $db->getResult_array($query);

        $body->setContent("data", $result);


        break;

    case 'insert':   // insert
        $body = new Template("dtml/lumino/html/warehouse/warehouse_form.html");
        $body->setContent("top", ["Warehouse","Insert Warehouse"]);
        $body->setContent("title", "Insert Warehouse");
        $body->setContent("submit", "Insert warehouse");

        if (isset($_POST['area'])){
          $query="INSERT INTO Warehouse (`Area`,`Sector`,`Description`)
                  VALUES(
                    '{$_POST['area']}',
                    '{$_POST['sector']}',
                    '{$_POST['description']}');";

          $result = $db->query($query);
          $body->setContent("notification", $result);
        }
        break;

    case 'delete':   // delete

        //query
        $query="DELETE FROM  Warehouse
                WHERE Area='{$_GET['area']}'
                AND Sector='{$_GET['sector']}';";
        $result = $db->query($query);
        //query.

    case 'update':   // update
      $body = new Template("dtml/lumino/html/warehouse/warehouse_list.html");
      $body->setContent("top", ["Warehouse","Warehouse Update"]);
      $body->setContent("title", "Warehouse Update");

      $query="SELECT * FROM Warehouse;";
      $result = $db->getResult_array($query);

      $body->setContent("report_update", $result);
    break;

    case 'edit':   // report
    //Caricamento dati pagina
    $body = new Template("dtml/lumino/html/warehouse/warehouse_form.html"); // TEMPLATE
    $body->setContent("top", ["Warehouse","Warehouse Edit"]); // ADDRESS
    $body->setContent("title", "Warehouse Edit"); // TITOLO
    $body->setContent("submit", "Save warehouse"); //BUTTOM

    if (isset($_POST['area'])){

        //query
        $query="UPDATE Warehouse SET
                  Area ='{$_POST['area']}',
                  Sector = '{$_POST['sector']}',
                  Description ='{$_POST['description']}'
                  WHERE Area='{$_POST['oldArea']}'
                  AND Sector='{$_POST['oldSector']}';";
        $result = $db->query($query);
        //.query

        $body->setContent("notification", $result); //SET NOTIFICATION
    }

    //Recupero dati
    $query="SELECT * FROM  Warehouse
            WHERE Area='{$_REQUEST['area']}'
            AND Sector='{$_REQUEST['sector']}';";
    $result = $db->getResult_array($query);



    //Caricamento dati
    $body->setContent("area",$result[0]['Area']);
    $body->setContent("sector",$result[0]['Sector']);
    $body->setContent("description",$result[0]['Description']);

    break;

}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
