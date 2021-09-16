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
        return $this->dao->get_flights($search, $offset, $limit, $order);
    }

    public function get_flight_by_id($id)
    {
        return $this->dao->get_flight_by_id($id);
    }

    public function update_flight($flightid, $flights)
    {
        $this->dao->update($flightid, $flights);
    }

    public function delete_flight($id)
    {
        $this->dao->delete_flight($id);
    }

    public function insert_new_flight($table, $data)
    {
        try {
            return $this->dao->insert($table, $data);
        } catch (\Exception$e) {
            if (str_contains($e->getMessage(), 'airport_id_key')) {
                throw new Exception("Airport does not exist", 400, $e);
            } else {
                throw $e;
            }
        }

    }
}
