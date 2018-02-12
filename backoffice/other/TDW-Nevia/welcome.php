<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $main = new Template("dtml/nevia/frame-public.html");
    $body = new Template("dtml/nevia/login.html");


    $main->SetContent("body", $body->get());
    $main->close();

?>
