

<?php

require_once dirname(__FILE__)."/../config.php";

class BaseDao{

    protected $connection;

    
    public function __construct()
    {
        try {
        $this->connection = new PDO("mysql:host=" .Config::DB_HOST. ";dbname=".Config::DB_SCHEME,Config::DB_USERNAME,Config::DB_PASSWORD);
        
        // Error exceptions
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
         //echo "Connected!";
        
        // echo "Connected successfully";
        } catch(PDOException $e) {
        throw $e;
        }
    }

    protected function insert($table, $entity){
        $query = "INSERT INTO ${table} (";
        foreach ($entity as $column => $value) {
          $query .= $column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
          $query .= ":".$column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    
        $stmt= $this->connection->prepare($query);
        $stmt->execute($entity); 
        $entity['id'] = $this->connection->lastInsertId();
        return $entity;
      }

    public function update(){


    }

    public function query($query, $params)
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query_unique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }


}

?>