<?php

Class DB {
  var
  $host, $user, $pass, $dbname, $connection;


  switch ($_SERVER['SERVER_NAME']) {
    case "localhost":
    echo "qui";
    $db = new DB("localhost", "root", "root", "tdw1718_1");
    echo "string";
    break;
    case "www.prova.it":
    $db = DB("sql.aruba.com", "username", "password", "dbname");
  }


  function __construct($host,$user,$pass,$dbname) {
    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->dbname = $dbname;

    $this->connection = new mysqli($host,$user,$pass,$dbname);

  }

  function query($query) {
    $con = $this->connection;
    return $con->query($query);
  }

  function getResult($query) {

    $queryResult = $this->query($query);

    if ($queryResult) {

      do {

        $data = $queryResult->fetch_assoc();

        if ($data) {
          $result[] = $data;
        }

      } while ($data);

    }

    return $result;

  }

}
?>
