<?php

require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class AccountService extends BaseService{
    public function __construct()
    {
        $this->dao = new AccountsDao();
    }

    public function get_accounts($search, $offset, $limit){
        if($search) {
            return $this->dao->get_accounts($search, $offset, $limit);
    
        } else {
            return $this->dao->get_all($offset,$limit);
        }

    }

    public function add($account) {
        //validation of accoutn data;
        if (!isset($account['username'])) throw new Exception("Name is missing");


        return parent::add($account);
    }

    
}

?>