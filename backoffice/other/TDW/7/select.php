<?php

    require "include/dbms.inc.php";
    
    $result = $db->query("SELECT * FROM users ORDER BY surname, name");
     
    if ($result) {
        echo "<!-- table begin -->\n<table>\n";
        do {
                
            $data = $result->fetch_assoc();

            
            if ($data) {
                echo "  <tr>\n";
                foreach ($data as $i => $v) {
                    echo "     <td>$v</td>\n";
                }
                echo "  </tr>\n";
            } 
         
        } while ($data);
     
        echo "</table>\n<!-- table end -->\n";
    } else {
        echo "query KO";
        exit;
    }

?>

