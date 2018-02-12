<?php

if(isset($_SESSION['auth'])){

    $main->setContent("place1", "<a href=\"#\"><i class=\"fa fa-user-o\" aria-hidden=\"true\"></i>Profilo</a>");
    $main->setContent("place2", "<a href=\"#\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>Logout</a>");
}

$main->setContent("place1", "<a href=\"#\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i>Sign In</a>");
$main->setContent("place2", "<a href=\"#\"><i class=\"fa fa-user-plus\" aria-hidden=\"true\"></i>Register</a>");
