<?php
        

    echo "<strong>INSERT INTO users VALUES (
        NULL, 
        '{$_POST['name']}', 
        '{$_POST['surname']}', 
        '{$_POST['email']}', 
        '{$_POST['note']}')</strong>";

?>