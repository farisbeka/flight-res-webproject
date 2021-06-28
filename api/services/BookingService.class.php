<?php

require_once dirname(__FILE__) . "/../dao/BookingDao.class.php";
require_once dirname(__FILE__) . "/../dao/BaseDao.class.php";
require_once dirname(__FILE__) . "/BaseService.class.php";

class BookingService extends BaseService
{

    public function __construct()
    {
        $this->dao = new BookingDao();
    }

    public function insert_new_booking($table, $data)
    {
        return $this->dao->insert_new_booking($table, $data);
    }

    public function get_booking($id)
    {
        return $this->dao->get_booking($id);

    }

    public function get_booking_by_id($id)
    {
        return $this->dao->get_booking_by_id($id);

    }

    public function update_booking($id, $booking)
    {
        $this->dao->update($id, $booking);
    }

}
