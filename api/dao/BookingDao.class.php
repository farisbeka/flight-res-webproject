<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class BookingDao extends BaseDao{

    public function return_booking_by_id($id)
    {
        return $this->query_unique("SELECT * FROM booking WHERE id=:id", ["id" => $id]);
    }
}

?>