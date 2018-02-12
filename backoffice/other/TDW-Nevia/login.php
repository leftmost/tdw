<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $main = new Template("dtml/nevia/frame-public.html");

    $body = new Template("dtml/nevia/login.html");


    if (!isset($_REQUEST['step'])) {
      $_REQUEST['step'] = 0;
    }

    switch ($_REQUEST['step']) {
      case 0:   //Login
      echo "Login 0";
      $body = new Template("dtml/nevia/login.html");

      break;

      case 1:   //Login request
      echo "Login request: ";



      $result = $db->getResult_array("SELECT * FROM users
                                 WHERE username = '{$_POST['username']}'
                                   AND password = '{$_POST['password']}'");


      if(count($result)>0){

        session_start();
        $_SESSION['auth'] = $result[0];
        echo "ACCEPT";
        $body = new Template("dtml/nevia/home.html");

      }else {
        echo "DANIED";
        $body = new Template("dtml/nevia/login.html");
      $body->setContent("notification", 'notice');
      }



      break;
    }

    $main->SetContent("body", $body->get());
    $main->close();

?>
