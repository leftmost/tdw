<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $main = new Template("dtml/shop/Login/login.html");


    if (isset($_POST['username'])) {
      //Query
      $query="SELECT *
              FROM Users
              WHERE username='{$_POST['username']}';";
      $result = $db->getResult_array($query);
      //-->end Query


      if(empty($result)){
        $main->setContent("err_login", "Utente non trovato!");
      }else{
        if($_POST['password']!=$result[0]['Password']){
          $main->setContent("username",$_POST['username']);
          $main->setContent("err_login", "Password non corretta!");
        }else{
          session_start();
          $_SESSION['auth'] = $result[0];

          

          Header("Location: index.php");
        } //if-password
      } //if-empty
    } //if-(_POST)


    $main->close();


?>
