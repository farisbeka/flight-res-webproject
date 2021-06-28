<?php

require_once dirname(__FILE__) . "/../dao/AirportsDao.class.php";
require_once dirname(__FILE__) . "/../dao/BaseDao.class.php";
require_once dirname(__FILE__) . "/BaseService.class.php";

class Airportsservice extends BaseService
{

    public function __construct()
    {
        $this->dao = new AirportsDao();
    }

    public function get_airports($search, $offset, $limit, $order)
    {
        if ($search) {
            return $this->dao->get_airports($search, $offset, $limit, $order);

        } else {
            return $this->dao->get_all($offset, $limit, $order);
        }

    }

    public function get_airport_by_id($id)
    {
        return $this->dao->get_airport_by_id($id);

    }

    public function update_airport($airportid, $airports)
    {
        $this->dao->update($airportid, $airports);
    }

    public function insert_new_airport($table, $data)
    {
        return $this->dao->insert($table, $data);
    }

}
