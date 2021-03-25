<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class AirportsDao extends BaseDao{

    public function __construct()
    {
        parent::__construct("airports");
    }

    public function return_airport_by_id($id)
    {
        return $this->query_unique("SELECT * FROM airports WHERE airportid=:id", ["id" => $id]);
    }

    public function return_airport_by_city($city)
    {
        return $this->query_unique("SELECT * FROM airports WHERE airport_city=:city", ["city" => $city]);
    }

    public function insert_new_airport($table, $data)
    {
        return $this->insert($table, $data);
    }
}


?>