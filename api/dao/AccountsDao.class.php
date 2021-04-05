<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

$tablename="accounts";

class AccountsDao extends BaseDao {

    public function __construct()
    {
        parent::__construct("accounts");
    }

    public function get_user_by_email($email)
    {
        return $this->query_unique("SELECT * FROM accounts WHERE email=:email", ["email" => $email ]); 
    }


    public function get_user_by_username($username)
    {
        return $this->query_unique("SELECT * FROM accounts WHERE username=:username", ["username"=>$username]);
    }

    public function insert_new_account($tablename, $entity)
    {
        return $this->insert($tablename, $entity);
    }

    public function get_all_accounts() {

        return $this->query("SELECT * FROM accounts", []);
    }

    public function update_account($id, $account) {
        $this->update("accounts", $id, $account);
    }

    public function get_accounts($search, $offset, $limit, $order){

        list($order_column, $order_direction) = self::parse_order($order);


        return $this->query("SELECT * FROM accounts 
                             WHERE LOWER(username) LIKE CONCAT('%', :username, '%') 
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}", 
                             ["username"=>strtolower($search)]);
    }

    public function get_user_by_token($token){
        return $this->query_unique("SELECT * FROM accounts WHERE token = :token", ["token" => $token]);
      }

}



?>