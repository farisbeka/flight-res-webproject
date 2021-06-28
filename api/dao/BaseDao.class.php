

<?php

require_once dirname(__FILE__)."/../config.php";


/**
 * The main class for interaction with database.
 * All other dao classes should inherit this class.
 * @author Faris Bektas
 */

class BaseDao{

    protected $connection;
    private $table;

    public static function parse_order($order) {

      switch(substr($order,0,1)) {
        case '-': $order_direction = "ASC"; break;
        case '+': $order_direction = "DESC"; break;
            default: throw new Exception("Invalid order format. First character should be either - or +"); break;

    };

    $order_column = substr($order, 1); 

    return [$order_column, $order_direction];

    }

    
    public function __construct($table)
    {
        $this->table=$table;
                try {
                  if (getenv("HEROKU")){
        $this->connection = new PDO("mysql:host=" .getenv("DB_HOST"). ";dbname=".getenv("DB_SCHEME"),getenv("DB_USERNAME"),getenv("DB_PASSWORD"));

                  } else{
                              $this->connection = new PDO("mysql:host=" .Config::DB_HOST. ";dbname=".Config::DB_SCHEME,Config::DB_USERNAME,Config::DB_PASSWORD);

                  }        
        // Error exceptions
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //$this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        
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


    public function insert($table, $entity){
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
     
      public function execute_update($table, $id, $entity, $id_column = "id"){
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

    public function get_all($offset, $limit, $order){

      list($order_column, $order_direction) = self::parse_order($order);

      return $this->query("SELECT * FROM ".$this->table."
      ORDER BY ${order_column} ${order_direction}
      LIMIT ${limit} OFFSET ${offset}" , []);
    }

    public function get_user_by_id($id){
      return $this->query_unique("SELECT * FROM accounts WHERE id=:id", ["id" => $id]);
  }

  public function get_airport_by_id($id)
    {
        return $this->query_unique("SELECT * FROM airports WHERE airportid=:id", ["id" => $id]);
    }


}

?>