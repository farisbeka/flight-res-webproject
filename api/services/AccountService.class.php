<?php

require_once dirname(__FILE__)."/../dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/AirportsDao.class.php";
require_once dirname(__FILE__)."/../clients/SMTPClient.class.php";


class AccountService extends BaseService{

  private $smtpClient;

    public function __construct()
    {
        $this->dao = new AccountsDao();
        $this->smtpClient = new SMTPClient();
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
            "password" => md5($account['password']),
            "token" => md5(random_bytes(16))
          ]);
              print_r($account);
              
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

    $this->smtpClient->send_register_user_token($account);

    return $account;
    
}

public function confirm($token){

  $account = $this->dao->get_user_by_token($token);

  if (!isset($account['id'])) throw new Exception("Invalid token", 400);

  $this->dao->update_account($account['id'], ["status" => "ACTIVE", "token" => $token]);
  return $account;
}

public function login($account) {

  $db_account = $this->dao->get_user_by_email($account['email']);

  if(!isset($db_account['id'])) throw new Exception("User does not exist", 400);

  if($db_account['status'] != 'ACTIVE') throw new Exception("Account not active", 400);

  if($db_account['password'] != md5($account['password'])) throw new Exception("Invalid password", 400);

  return $db_account;
}

public function forgot($account) {

  $db_account = $this->dao->get_user_by_email($account['email']);

  if(!isset($db_account['id'])) throw new Exception("User does not exist", 400);

  if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_account['token_created_at']) < 300) throw new Exception("Be patient! Token is on his way.", 400);


  //generate token, save it do db
  $db_account = $this->update($db_account['id'], ['token' => md5(random_bytes(16)), 'token_created_at' => date(Config::DATE_FORMAT)]);

  //send email
  $this->smtpClient->send_user_recovery_token($db_account);
}

public function reset($account) {

  $db_account = $this->dao->get_user_by_token($account['token']);

  if (!isset($db_account['id'])) throw new Exception("Invalid token", 400);

  if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_account['token_created_at']) > 300) throw new Exception("Toxen has expired", 400);
   

  $this->dao->update($db_account['id'], ['password' => md5($account['password'])]);
}

}

?>