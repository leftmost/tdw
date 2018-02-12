<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
$area=$_POST['area'];
// toDelete $temp="";
if($_POST['sector']!=""){

  $query="SELECT sector FROM Warehouse WHERE area='$area';";
  $data = $db->getResult_array($query);


    $option="sector"; // colonna da scegliere nel box
    $value="sector";   // colonna da assegnare
    $result="<label>Sector*</label>";

    $result.="<select id=\"sector\" name=\"sector\" class=\"form-control\" required>\n";
    foreach($data as $row) {//to delete $temp.=$_POST['sector']." = ".$row[$value]." /";
    $result .="<option value=\"$row[$value]\"";
    if($_POST['sector']== $row[$value]){
      $result .= "selected"; // toDelete echo $_POST['sector'];
    }
    $result.=">$row[$option]</option>\n";
    }
    $result.="</select>\n";


  echo $result;
  // toDelete echo $temp;
}


else{
$query="SELECT sector FROM Warehouse WHERE area='$area';";
$data = $db->getResult_array($query);


  $option="sector"; // colonna da scegliere nel box
  $value="sector";   // colonna da assegnare
  $result="<label>Sector*</label>";
  $result.="<select id=\"sector\" name=\"sector\" class=\"form-control\" required>\n";
  foreach($data as $row) {
  $result .="<option value=\"$row[$value]\">$row[$option]</option>\n";
  }
  $result.="</select>\n";




echo $result;
}
