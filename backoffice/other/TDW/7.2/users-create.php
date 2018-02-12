<?php
        
    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    
    $main = new Template("dtml/nevia/frame-public.html");
    
    
    if (!isset($_POST['step'])) {
        $_POST['step'] = 0;
    } 
    
    $body = new Template("dtml/nevia/users-create.html");
    
    switch ($_POST['step']) {
        case 0:        
            break;
            
        case 1:
            
            $result = $db->query("INSERT INTO users VALUES (
                                    0,
                                    '{$_POST['name']}',
                                    '{$_POST['surname']}',
                                    '{$_POST['email']}',
                                    '{$_POST['note']}')");
            
            $body->setContent("notification", $result);
            
            break;
    }
    
    
    
    
    $main->SetContent("body", $body->get());
    $main->close();

?>