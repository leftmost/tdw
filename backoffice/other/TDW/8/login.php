<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    require "include/auth.inc.php";
    
    
    $main = new Template("dtml/nevia/frame-public.html");
    $body = new Template("dtml/nevia/welcome.html");
    
    
    $main->setContent("body", $body->get());
    $main->close();
    
    
?>

