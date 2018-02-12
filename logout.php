<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";

    unset($_SESSION['auth']);

    Header("Location: index.php");


?>
