<?php


require_once dirname(__FILE__)."/BaseDao.class.php";

class FlightsDao extends BaseDao {

    public function return_flight_by_id($id)
    {
        return $this->query_unique("SELECT * FROM flights WHERE flightid=:id", ["id" => $id]);
    }

    public function return_flight_by_direction($direction)
    {
        return $this->query_unique("SELECT * FROM flights WHERE flight_direction=:direction", ["direction" => $direction]);
    }
    
}

?>