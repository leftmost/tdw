<?php

    require "include/template2.inc.php";
    
    $main = new Template("dtml/nevia/frame-public.html");
    $body = new Template("dtml/nevia/home.html");
    
    
    
    
    $main->setContent("body", $body->get());
    $main->close();
    
    
?>

