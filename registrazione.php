<?php
require "include/template2.inc.php";
require "include/dbms.inc.php";
require "include/auth.inc.php";


$main = new Template("dtml/shop/Login/sign-in.html");


require "include/credential.inc.php"; //frame public secondo la login




if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])){

  if($_POST['email'] !="" && $_POST['username'] !="" && $_POST['password'] !=""){

    //creazione Custumer List
    $query = "INSERT INTO  CustumerList(Name,Surname,Address,City) VALUES('','','','')";
    $result = $db->query($query);

    $query = "SELECT MAX(id) as id FROM  CustumerList;";
    $result = $db->getResult_array($query);
    $id_CustumerList=$result[0]['id'];
    //end


    //query inserimento dati
    $query="INSERT INTO Users (Username, Password, Email, id_CustumerList) VALUES ('{$_POST["username"]}', '{$_POST["password"]}', '{$_POST["email"]}', $id_CustumerList);";
    $result = $db->query($query);



    if($result == 1){

      $main->setContent("succ_reg", "Registrazione completata con successo!");

      $query="SELECT *
              FROM Users
              WHERE username='{$_POST['username']}';";
      $result = $db->getResult_array($query);

      //session_start();
      $_SESSION['auth'] = $result[0];


      Header("refresh: 2; url=index.php");


    }elseif($result == "Duplicate entry '{$_POST['username']}' for key 'PRIMARY'"){

      $main->setContent("err_reg", "Username non valido!");
    }
      else{

        $main->setContent("err_reg", "Email non valida!");
      }

    }

  }






$main->close();
