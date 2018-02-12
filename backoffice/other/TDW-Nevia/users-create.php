<?php

    require "include/auth.inc.php";
    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $main = new Template("dtml/nevia/frame-public.html");
    $body = new Template("dtml/nevia/users-create.html");

    if (!isset($_POST['step'])) {
      echo "step 0";
        $_POST['step'] = 0;
    }
    else{
      echo "step 1";
    $query= " INSERT INTO users_old (name,surname) VALUES (
                                      '{$_POST['name']}',
                                      '{$_POST['surname']}');";
    $result = $db->query($query);
    $body->setContent("notification", 'success');
    }

    $main->SetContent("body", $body->get());
    $main->close();

?>
