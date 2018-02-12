<?php

    Class DB {
        var
            $host, $user, $pass, $dbname, $connection;

        function __construct($host,$user,$pass,$dbname) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->dbname = $dbname;
            $this->connection = new mysqli($host,$user,$pass,$dbname) ;

            if ($this->connection->connect_error) {
              die('Connect Error (' . $this->connection->connect_errno . ') '
              . $this->connection->connect_error);
            }

             // echo 'Success... ' . $this->connection->host_info . "\n";

        }
        // ritorna 1 per query eseguita, altrimenti $result= tipo errore
        function query($query) {
            $con = $this->connection;
            $result= $con->query($query) or $result=$con->error;

            return $result;
        }

        function getResult_assoc($query) {

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

        function getResult_array($query) {

            $queryResult = $this->query($query);


                do {
                    $data = $queryResult->fetch_array();
                    if ($data) {
                        $result[] = $data;
                    }
                } while ($data);
            if(!isset($result)){
              $result=array();
            }
            return $result;
        }

    }

    switch ($_SERVER['SERVER_NAME']) {
        case "localhost":
            $db = new DB("localhost", "root", "root", "eCommerce");
            break;
        case "tdw.altervista.org":
            $db = DB("localhost", "tdw", "", "my_db");
            break;
    }




?>
