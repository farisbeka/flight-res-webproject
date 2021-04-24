<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class BookingDao extends BaseDao{

    public function __construct()
    {
        parent::__construct("booking");
    }


    public function get_booking() {

        return $this->query("SELECT * FROM booking", []);
    }

    public function insert_new_booking($table, $data)
    {
        return $this->insert($table, $data);
    }

    public function get_booking_by_id($id)
    {
        return $this->query_unique("SELECT * FROM booking WHERE id=:id", ["id" => $id]);
    }

    public function update_booking($id, $booking) {
        $this->update("booking", $id, $booking);
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

}

?>