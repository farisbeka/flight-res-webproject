<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class BookingDao extends BaseDao{

    public function __construct()
    {
        parent::__construct("booking");
    }


    public function return_booking_by_id($id)
    {
        return $this->query_unique("SELECT * FROM booking WHERE booking_id=:id", ["id" => $id]);
    }

    public function insert_new_booking($table, $data)
    {
        return $this->insert($table, $data);
    }
}

?>