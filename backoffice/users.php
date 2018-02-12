<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";

$main = new Template("dtml/lumino/html/frame-public.html");


if (!isset($_REQUEST['page'])) {
  $_REQUEST['page'] = 'list';
}

switch ($_REQUEST['page']) {
  case 'list':   // REPORT
  $body = new Template("dtml/lumino/html/users/users_list.html");
  $body->setContent("top", ["Users","Users List"]);
  $body->setContent("title","Users List");

  //Query report users
  $query="SELECT Name_Groups as Groups,Username,Email,Password,Name,Surname,Address,City
  FROM Users
  LEFT JOIN CustumerList ON Users.id_CustumerList = CustumerList.id
  LEFT JOIN Users_Groups ON Users.Username = Username_Users
  GROUP BY Username;";
  $result = $db->getResult_array($query);
  //.Query

  $body->setContent("data", $result); //Notifica

  break;

  case 'insert':   // INSERIMENTO UTENTE
  $body = new Template("dtml/lumino/html/users/users_form.html");
  $body->setContent("top", ["Users","Insert Users"]);
  $body->setContent("title","Insert User");
  $body->setContent("submit"," Insert User");

  //Query option Groups
  $query="SELECT Name FROM Groups;";
  $result = $db->getResult_array($query);
  $body->setContent("nochecked", $result);
  //.Query


  //SALVATAGGIO INSERIMENTO
  if (isset($_POST['username'])){
    //rimozione slashes
    $city=addslashes($_POST['city']);
    $address=addslashes($_POST['address']);
    //.rimozione

    //Query creazione CustumerList
    $query = "INSERT INTO  CustumerList(Name,Surname,Address,City)
              VALUES(
                '{$_POST['name']}',
                '{$_POST['surname']}',
                '$address',
                '$city'
              )";
    $result = $db->query($query);
    //.Query

    //Query inserisco collegamento
    $query = "SELECT MAX(id) as id FROM  CustumerList;";
    $result = $db->getResult_array($query);
    //.Query

    $id_CustumerList=$result[0]['id'];


    //Query creazione Users con CustumerList
    $query="INSERT INTO Users(Username,Email,Password,id_CustumerList)
            VALUES(
                    '{$_POST['username']}',
                    '{$_POST['email']}',
                    '{$_POST['password']}',
                    $id_CustumerList
                  );";
    $result = $db->query($query);
    //.Query

    foreach ($_POST['groups'] as $key => $value) {
      // Query inserimento Groups
      $query="INSERT INTO Users_Groups(Username_Users,Name_Groups)
        VALUES('{$_POST['username']}',
                '$value'
              );";
      $result = $db->query($query);
      //.Query
    }

    $body->setContent("notification", $result); //Notifica
  }

  break;

  case 'delete':   // delete
  $query="DELETE FROM Users WHERE username='{$_GET['username']}'";
  $result = $db->query($query);

  case 'update':   // update
  $body = new Template("dtml/lumino/html/users/users_list.html");
  $body->setContent("top", ["Users","Update List"]);
  $body->setContent("title","Update List");

  //Query  report users
  $query="SELECT Username,Email FROM Users;";
  $result = $db->getResult_array($query);
  //.Query
  $body->setContent("report_update", $result);

  break;

  case 'edit':   // edit

  $body = new Template("dtml/lumino/html/users/users_form.html");
  $body->setContent("top", ["Users","Edit Users"]);
  $body->setContent("title","Edit User");
  $body->setContent("submit"," Save User ");

  if(isset($_POST['oldUsername'])){
    $city=addslashes($_POST['city']);
    $address=addslashes($_POST['address']);

    //Query
    $query="DELETE FROM Users_Groups WHERE Username_Users='$_POST[oldUsername]';";
    $result = $db->query($query);
    //.Query

    //Query
    foreach ($_POST['groups'] as $key => $value) {
      // Query inserimento Groups
      $query="INSERT INTO Users_Groups(Username_Users,Name_Groups)
        VALUES('{$_POST['username']}',
                '$value'
              );";
      $result = $db->query($query);
      //.Query
    }
    //.Query

    //visulizzo

    //Recupero Id CustumerList
    $query ="SELECT id_CustumerList FROM Users WHERE username='{$_POST['oldUsername']}';";
    $result = $db->getResult_array($query);
    $id_CustumerList=$result[0]['id_CustumerList'];

    // UPDATE CustumerList
      $query = "UPDATE  CustumerList
                SET
                  name='{$_POST['name']}',
                  surname='{$_POST['surname']}',
                  address='$address',
                  city='$city'
                WHERE id ='$id_CustumerList';";

      $result = $db->query($query);

      // UPDATE Users
      $query = "UPDATE  Users
                SET
                  username='{$_POST['username']}',
                  email='{$_POST['email']}',
                  password='{$_POST['password']}'
                WHERE username ='{$_POST['oldUsername']}';";

      $result = $db->query($query);
      $body->setContent("notification", $result); //notifica
  }


  $query="SELECT Name_Groups as Name, Username_Users FROM  Users_Groups
          WHERE Username_Users='{$_GET['username']}';";
  $checked = $db->getResult_array($query);
  $body->setContent("check", $checked);

  $query="SELECT Name FROM Groups;";
  $result = $db->getResult_array($query);
  //funzione rimozione
  foreach ($result as $keys => $values) {
    foreach ($checked as $key => $value) {
      if($value[0]==$values[0]){unset($result[$keys]);}
    }
  }
  $body->setContent("nochecked", $result);


  $query="SELECT * FROM  Users
          LEFT JOIN  CustumerList ON Users.id_CustumerList=CustumerList.id
          WHERE username='{$_GET['username']}';";
  $result = $db->getResult_array($query);

  $body->setContent("username", $result[0]['Username']);
  $body->setContent("email", $result[0]['Email']);
  $body->setContent("password", $result[0]['Password']);
  $body->setContent("name", $result[0]['Name']);
  $body->setContent("surname", $result[0]['Surname']);
  $body->setContent("address", $result[0]['Address']);
  $body->setContent("city", $result[0]['City']);
  break;

}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();
