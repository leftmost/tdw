<?php

if(isset($_SESSION['auth'])){

    $main->setContent("place1", "<a href=\"profilo.php?page=informazioni\"><i class=\"fa fa-user-o\" aria-hidden=\"true\"></i>Profilo</a>");
    $main->setContent("place2", "<a href=\"logout.php\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i>Logout</a>");
    $main->setContent("profilo", "Il Mio Profilo");
    //query numero elementi nel carrello
    $query="SELECT SUM(Amount)  AS numero FROM Orders
            JOIN orders_product ON orders_product.Order_id=orders.id
            WHERE Orders.id_Status=2 AND Orders.Username_Users='{$_SESSION['auth']['Username']}';";
    $result = $db->getResult_array($query);

    //query

    if(empty($result[0]['numero'])){
      $data="";
    }else{

      $data="<span id=\"checkout_items\" class=\"checkout_items\">{$result[0]['numero']}</span>";

    }
    $main->setContent("numcarrello",$data);

}else{

$main->setContent("place1", "<a href=\"login.php\"><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i>Login</a>");
$main->setContent("place2", "<a href=\"registrazione.php\"><i class=\"fa fa-user-plus\" aria-hidden=\"true\"></i>Registrati</a>");
$main->setContent("profilo", "&nbsp; Accedi &nbsp;");
}
