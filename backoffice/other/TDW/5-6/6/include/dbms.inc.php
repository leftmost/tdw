<?php

    Class DB {
        var 
            $host, $user, $pass, $dbname, $connection;
        
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
    
    

    switch ($_SERVER['SERVER_NAME']) {
        case "localhost":
            $db = new DB("localhost", "root", "viva1felice", "tdw1718_1");
            break;
        case "www.prova.it":
            $db = DB("sql.aruba.com", "username", "password", "dbname");
    }
    
    
    

/*

    Class Database {
        static $entities;
        
        function registry(&$entity) {
            
            if (isset(Database::$entities[$entity->getName()])) {
                
                throw new Exception('Entity name already exists!');
            
            }
            
            Database::$entities[$entity->getName()] = $entity;
            
        }
        
    }

    Class Entity {
        
        var $name;
        
        function __constructor($name) {
            $this->name = $name;
            
            try {
                Database::registry($this);
                
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
   
        }
        
        function getName() {
            
            return $this->name;  
        }
        
    }

    new Entity("pippo");
*/
?>