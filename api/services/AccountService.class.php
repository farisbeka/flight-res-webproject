<?php

require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/AirportsDao.class.php";


class AccountService extends BaseService{

    public function __construct()
    {
        $this->dao = new AccountsDao();
    }

    public function get_accounts($search, $offset, $limit, $order){
        if($search) {
            return $this->dao->get_accounts($search, $offset, $limit, $order);
    
        } else {
            return $this->dao->get_all($offset,$limit, $order);
        }

    }

    public function register($account){
        if (!isset($account['username'])) throw new Exception("Account field is required");
    
        try {
          $this->dao->beginTransaction();
          $account = $this->dao->add([
            "username" => $account['username'],
            "email" => $account['email'],
            "password" => md5($account['password'])
          ]);


    $this->dao->commit();
    } 
    catch (\Exception $e) {
      $this->dao->rollBack();
      //accounts.email_UNIQUE
      if (str_contains($e->getMessage(), 'accounts.email_UNIQUE')) {
        throw new Exception("Account with same email exists in the database", 400, $e);
      }
      else{
        throw $e;
      }
    }

    return $account;
    
}
}

?>