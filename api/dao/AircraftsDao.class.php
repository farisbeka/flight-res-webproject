<?php

require_once dirname(__FILE__)."/BaseDao.class.php";


class AircraftsDao extends BaseDao{

    public function return_aircraft_by_id($id)
    {
        return $this->query_unique("SELECT * FROM aircrafts WHERE id=:id", ["id" => $id]);
    }

    public function return_aircrafts_by_destination($destination)
    {
        return $this->query("SELECT * FROM aircrafts WHERE destination=:destination", ["destination" => $destination]);
    }
}
?>