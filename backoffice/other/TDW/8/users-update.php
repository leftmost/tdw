<?php

        
    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    
    $main = new Template("dtml/nevia/frame-public.html");
    
    
    if (!isset($_REQUEST['step'])) {
        $_REQUEST['step'] = 0;
    } 
    
    
    
    switch ($_REQUEST['step']) {
        case 0:   // report
            
            
            
            $body = new Template("dtml/nevia/users-report.html");
            $result = $db->getResult("SELECT id, name, surname FROM users ORDER BY name, surname", NOASSOC);
            
            $body->setContent("data", $result);
            
            
            
            
            break;
            
        case 1:
            
            $body = new Template("dtml/nevia/users-update.html");
            
            $data = $db->getResult("SELECT * FROM users WHERE id = {$_REQUEST['key']}");
            $body->setContent($data[0]);
            
            $body->setContent("notification", "undefined");
           
            
            break;
        case 2:
            
            echo "STEP 2";
            
            $body = new Template("dtml/nevia/users-update.html");
            
            
            $result = $db->query("UPDATE users SET  
                                    name = '{$_POST['name']}',
                                    surname = '{$_POST['surname']}',
                                    email = '{$_POST['email']}',
                                    note = '{$_POST['note']}'
                                  WHERE id = {$_POST['id']}");
            
            
            
            $body->setContent("notification", $result);
            
            $result = $db->getResult("SELECT * FROM users WHERE id = {$_POST['id']}");
            
            
            $body->setContent($result[0]);
            
            break;
    }
    
    
    
    
    $main->SetContent("body", $body->get());
    $main->close();

?>