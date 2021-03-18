<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class AccountsDao extends BaseDao {

    public function get_user_by_email($email)
    {
        return $this->query_unique("SELECT * FROM accounts WHERE email=:email", ["email" => $email ]); 
    }

    public function get_user_by_username($username)
    {
        return $this->query_unique("SELECT * FROM accounts WHERE username=:username", ["username"=>$username]);
    }

}



?>