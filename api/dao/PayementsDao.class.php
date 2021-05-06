<?php


require_once dirname(__FILE__)."/BaseDao.class.php";

class PayementsDao extends BaseDao {

    public function __construct()
    {
        parent::__construct("payements");
    }


    public function get_payment_by_id($id)
    {
        return $this->query_unique("SELECT * FROM payements WHERE payementid=:id", ["id" => $id]);
    }

    public function return_payement_by_cardnum($cardnum)
    {
        return $this->query_unique("SELECT * FROM payements WHERE card_number=cardnum", ["cardnum => $cardnum"]);
    }

    public function get_payments() {

        return $this->query("SELECT * FROM payements", []);
    }

    public function insert_new_payment($table, $data)
    {
        return $this->insert($table, $data);
    }

    public function update_payment($payementid, $payements) {
        $this->update("payements", $payementid, $payements);
    }


    public function execute_update($table, $id, $entity, $id_column = "payementid"){
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