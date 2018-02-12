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
      $body = new Template("dtml/lumino/html/catalog/catalog_list.html");//TEMPLATE
      $body->setContent("top", ["Catalogs","Catalog List"]);//INDIRIZZO
      $body->setContent("title","Catalog List"); //TITOLO

      //Query report
      $query="SELECT Type,Year,Collection,Description FROM  Catalogs;";
      $result = $db->getResult_array($query);
      //.Query

      $body->setContent("data", $result); // SET REPORT

    break;

    case 'insert':   // Inserimento catalogo
      $body = new Template("dtml/lumino/html/catalog/catalog_form.html");//TEMPLATE
      $body->setContent("top", ["Catalogs","Insert Catalog"]);//INDIRIZZO
      $body->setContent("title","Insert Catalog");//TITOLO
      $body->setContent("submit"," Insert Catalog");// BUTTOM

      //Salvataggio inserimento
      if (isset($_POST['type'])){

        //Query inserimento
        $query="INSERT INTO Catalogs (`Type`,`Year`,`Collection`,`Description`)
                VALUES('{$_POST['type']}',
                       '{$_POST['year']}',
                       '{$_POST['collection']}',
                       '{$_POST['description']}');";
        $result = $db->query($query);
        //.Query

        $body->setContent("notification", $result); // SET NOTIFICA
      }
    break;

    case 'delete':  // delete catalog
        //Query delete
        $query="DELETE FROM Catalogs WHERE id='{$_GET['id']}'";
        $result = $db->query($query);
        //.Query

    case 'update':   // report update
      $body = new Template("dtml/lumino/html/catalog/catalog_list.html"); //TEMPLATE
      $body->setContent("top", ["Catalogs","Catalog List"]); //INDIRIZZO
      $body->setContent("title","Catalog List"); //TITOLO

      //Query report update
      $query="SELECT id,Type,Year,Collection FROM Catalogs;";
      $result = $db->getResult_array($query);
      //.Query

      $body->setContent("report_update", $result); // SET REPORT

    break;

    case 'edit':   // edit catalog

        $body = new Template("dtml/lumino/html/catalog/catalog_form.html"); //TEMPLATE
        $body->setContent("top", ["Catalog","Edit Catalog"]); //INDIRIZZO
        $body->setContent("title","Edit Catalog"); //TITOLO
        $body->setContent("submit"," Save Catalog"); //BUTTOM

        //Update
        if(isset($_POST['type'])){

          //Query update
          $query="UPDATE Catalogs SET
                      type = '{$_POST['type']}',
                      year = '{$_POST['year']}',
                      collection = '{$_POST['collection']}',
                      description ='{$_POST['description']}'
                      WHERE id='{$_POST['id']}';";
          $result = $db->query($query);
          //.Query

          $body->setContent("notification", $result); //SET NOTFICATION
        }
        $query="SELECT * FROM Catalogs WHERE id='{$_GET['id']}'";
        $result = $db->getResult_array($query);

        $body->setContent("id", $result[0]['id']);

        switch ($result[0]['Type']) {
          case 'Women': $body->setContent("checkWomen", "checked");
          break;
          case 'Men': $body->setContent("checkMen", "checked");
          break;
          case 'Kids': $body->setContent("checkKids", "checked");
          break;
        }

        switch ($result[0]['Collection']) {
          case 'spring/summer': $body->setContent("checkSpring", "checked");
          break;
          case 'autumn/winter': $body->setContent("checkWinter", "checked");
          break;
        }

        $body->setContent("year", $result[0]['Year']);
        $body->setContent("description", $result[0]['Description']);
        break;

}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
