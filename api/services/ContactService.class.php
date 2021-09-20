<?php

require_once dirname(__FILE__) . "/../dao/ContactDao.class.php";
require_once dirname(__FILE__) . "/../dao/BaseDao.class.php";
require_once dirname(__FILE__) . "/BaseService.class.php";

class Contactservice extends BaseService
{

    public function __construct()
    {
        $this->dao = new ContactDao();
    }

    public function insert_new_contact($table, $data)
    {
        return $this->dao->insert($table, $data);
    }
}
