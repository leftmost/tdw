<?php

    require "include/auth.inc.php";
    
    
    unset($_SESSION['auth']);
    
    Header("Location: index.php");
    
    
?>

