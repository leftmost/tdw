<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $main = new Template("dtml/lumino/html/login.html");


    if (isset($_POST['username'])) {
      //Query
      $query="SELECT *
              FROM Users
              WHERE username='{$_POST['username']}';";
      $result = $db->getResult_array($query);
      //-->end Query


      if(empty($result)){
        $main->setContent("notification", "USER NOT FOUND!");
      }else{
        if($_POST['password']!=$result[0]['Password']){
          $main->setContent("username",$_POST['username']);
          $main->setContent("notification", "PASSWORD INCORRECT");
        }else{
          session_start();
          $_SESSION['auth'] = $result[0];

          Header("Location: dashboard.php");
        } //if-password
      } //if-empty
    } //if-(_POST)


    $main->close();


?>
