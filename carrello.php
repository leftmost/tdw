<?php

require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";
//echo $_POST['radio'];exit;
$date = date('Y/m/d');

if (isset($_POST['id'])){
  if(!isset($_SESSION['auth']['Username'])){

    echo "<div id='delete' class=\"alert alert-warning\" role=\"alert\" style=\"margin-top:16px; margin-left:25px; padding:8px;\">
      <i class=\"fa fa-warning\" aria-hidden=\"true\"></i> Effettua l'accesso!
    </div>";
    exit;
  }
  // controlla se il prodotto è disponibile
  $query="SELECT * FROM products_warehouse
          WHERE id_products='{$_POST['id']}'
          AND size='{$_POST['radio']}'
          AND amount>0;";
  $result = $db->getResult_array($query);
  //query


  //se il prodotto è disponibile
  if(!empty($result)){

    //diminuisce il magazzino di una quantità
    $query="UPDATE products_warehouse
            SET Amount=Amount-1
            WHERE id_products='{$_POST['id']}'
            AND Size='{$_POST['radio']}';";
    $result = $db->query($query);
    //echo $result;exit;
    //query
  }else{
    echo "<div id='delete' class=\"alert alert-warning\" role=\"alert\" style=\"margin-top:16px; margin-left:25px; padding:8px;\">
      <i class=\"fa fa-warning\" aria-hidden=\"true\"></i> Prodotto non disponibile!
    </div>";
    exit;

  }


  // controlla se l'utente ha un ordine in sospeso
  $query="SELECT * FROM Orders
          JOIN Users ON Orders.Username_Users='{$_SESSION['auth']['Username']}'
          JOIN Status ON Orders.id_Status=2;";
  $result = $db->getResult_array($query);
  //query

  if(empty($result)){
    //Utente non ha ordini

    //Creazione ordine
    $query="INSERT INTO Orders(`Username_Users`,`CreationDate`,`id_Status`)
    VALUES('{$_SESSION['auth']['Username']}','$date','2')";
    $result = $db->query($query);
    //.Query

    //Id ordine appena creato
    $query="SELECT MAX(id) as id FROM Orders";
    $result = $db->getResult_array($query);
    $maxID=$result[0]['id'];
    //.query

    //aggiungi prodotto all'ordine
    $query="INSERT INTO Orders_Product(Order_id, Product_id, Amount, Size)
            VALUES('$maxID','{$_POST['id']}','1','{$_POST['radio']}')";
    $result = $db->query($query);
    
    //.Query
  }else{
    //utente ha un ordine in sospeso

    //Seleziono ordine in sospeso
    $query="SELECT * FROM Orders WHERE Username_Users='{$_SESSION['auth']['Username']}' AND id_Status=2";
    $result = $db->getResult_array($query);
    $idOrder=$result[0]['id'];
    //.query

    //aggiorno il carrello

    // se il prodotto già esiste, aggiorno quantità
    //Seleziono ordine in sospeso
    $query="SELECT * FROM Orders_Product
            WHERE Order_id='$idOrder'
            AND Product_id='{$_POST['id']}'
            AND Size='{$_POST['radio']}'";
    $prodottoCarrello = $db->getResult_array($query);
    //.query

    if(empty($prodottoCarrello)){
      //inserisco prodotto nel carrello
      $query="INSERT INTO Orders_Product(Order_id, Product_id, Amount, Size)
              VALUES('$idOrder','{$_POST['id']}','1','{$_POST['radio']}')";
      $result = $db->query($query);
      //.Query

    }else{
      //aggiorno carrello prodotto all'ordine
      $query="UPDATE Orders_Product
              SET Amount=Amount+1
              WHERE Order_id='$idOrder'
              AND Product_id='{$_POST['id']}'
              AND Size='{$_POST['radio']}';";
      $result = $db->query($query);
      //.Query
    }
  }
}
echo "<div id='delete' class=\"alert alert-success\" role=\"alert\" style=\"margin-top:16px; margin-left:25px; padding:8px;\">
  <i class=\"fa fa-check\" aria-hidden=\"true\"></i> Prodotto aggiunto al carrello!
</div>";

echo "<script type=\"text/javascript\">
      setTimeout(function(){
      $('#delete').remove();
      }, 2000);
      </script>";
