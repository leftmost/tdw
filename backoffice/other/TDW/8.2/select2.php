<?php

    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    
    $main = new Template("dtml/select.html");
    
    $main->setContent("oggetto", "TEST");

    $result = $db->getResult("SELECT * FROM users ORDER BY surname, name");

    // print_r($result);
    
    foreach($result as $user) {
        $main->setContent("name", $user['name']);
        $main->setContent("surname", $user['surname']);
    }
    
    
    $main->close();

?>

