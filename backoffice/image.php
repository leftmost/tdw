<?php

require "include/dbms.inc.php";

$query="SELECT * FROM Images
        WHERE id='{$_GET['id']}'";
$result = $db->getResult_array($query);

$img = $result[0]['Image'];
header('Content-type: image/jpeg');
echo $img;
exit;
