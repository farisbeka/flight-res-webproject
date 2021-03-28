

<?php

require_once dirname(__FILE__)."/../config.php";


/**
 * The main class for interaction with database.
 * All other dao classes should inherit this class.
 * @author Faris Bektas
 */

class BaseDao{

    protected $connection;

    
    public function __construct($table)
    {
        $this->table=$table;
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



    public function beginTransaction(){
      $response = $this->connection->beginTransaction();
    }
  
    public function commit(){
      $this->connection->commit();
    }
  
    public function rollBack(){
      $response = $this->connection->rollBack();
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

      protected function execute_update($table, $id, $entity, $id_column = "id"){
        $query = "UPDATE ${table} SET ";
        foreach($entity as $name => $value){
          $query .= $name ."= :". $name. ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";
    
        $stmt= $this->connection->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
      }

      public function update($id, $entity){
        $this->execute_update($this->table, $id, $entity);
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

    public function update_account($id, $account) {
      $this->update("accounts", $id, $account);
  }
    public function add($entity){
      return $this->insert($this->table, $entity);
    }

    public function get_all(){
      return $this->query("SELECT * FROM accounts" , []);
    }

    public function get_user_by_id($id){
      return $this->query_unique("SELECT * FROM accounts WHERE id=:id", ["id" => $id]);
  }


}

?>