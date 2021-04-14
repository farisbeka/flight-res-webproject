<?php

require_once dirname(__FILE__)."/../dao/BookingDao.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";


class BookingService extends BaseService {

    public function __construct()
    {
        $this->dao = new BookingDao();
    }

    public function insert_new_booking($table, $data)
    {
        return $this->dao->insert($table, $data);
    }


}

?>