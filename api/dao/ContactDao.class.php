<?php

require_once dirname(__FILE__) . "/BaseDao.class.php";

$tablename = "contact";

class ContactDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("contact");
    }

    public function insert_new_contact($table, $data)
    {
        return $this->insert($table, $data);
    }

}
