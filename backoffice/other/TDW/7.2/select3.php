<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    
    $main = new Template("dtml/select3.html");
    
    $main->setContent("oggetto", "TEST");

    $result1 = $db->getResult("SELECT * FROM users ORDER BY surname, name");
    $main->setContent("users", $result1);
    
    $result2 = $db->getResult("SELECT * FROM users ORDER BY surname, name LIMIT 2");
    $main->setContent("emails", $result2);
     
    $main->close();

?>

