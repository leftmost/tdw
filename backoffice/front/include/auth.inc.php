<?php

    session_start();

    if ((!isset($_POST['username'])) AND (!isset($_POST['password']))) {

        if (!isset($_SESSION['auth'])) {
            // non è in sessione

            Header("Location: error.php?id=1002");
            exit;
        }

    }





?>
