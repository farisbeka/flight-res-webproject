<?php

require_once dirname(__FILE__)."/../dao/FlightsDao.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class FlightService extends BaseService {

    public function __construct()
    {
        $this->dao = new FlightsDao();
    }
}
?>