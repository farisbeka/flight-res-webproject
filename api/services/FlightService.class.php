<?php

require_once dirname(__FILE__) . "/../dao/FlightsDao.class.php";
require_once dirname(__FILE__) . "/../dao/BaseDao.class.php";
require_once dirname(__FILE__) . "/BaseService.class.php";

class flightService extends BaseService
{

    public function __construct()
    {
        $this->dao = new FlightsDao();
    }

    public function get_flights($search, $offset, $limit, $order)
    {
        if ($search) {
            return $this->dao->get_flights($search, $offset, $limit, $order);

        } else {
            return $this->dao->get_all($offset, $limit, $order);
        }

    }

    public function get_flight_by_id($id)
    {
        return $this->dao->get_flight_by_id($id);
    }

    public function update_flight($flightid, $flights)
    {
        $this->dao->update($flightid, $flights);
    }

    public function insert_new_flight($table, $data)
    {
        return $this->dao->insert($table, $data);
    }
}
