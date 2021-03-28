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

    public function get_all_accounts($offset, $limit, $search, $order='-id') {

        return $this->query("SELECT * FROM accounts", []);
    }

    public function update_account($id, $account) {
        $this->update("accounts", $id, $account);
    }

    public function get_accounts($search, $offset, $limit, $order){

        switch(substr($order,0,1)) {
            case '-': $order_direction = "ASC"; break;
            case '+': $order_direction = "DESC"; break;
                default: throw new Exception("Invalid order format. First character should be either - or +"); break;

        };

        $order_column = $this->connection->quote(substr($order, 1)); 

        return $this->query("SELECT * FROM accounts 
                             WHERE LOWER(username) LIKE CONCAT('%', :username, '%') 
                             ORDER BY ${order_column} ${order_direction}
                             LIMIT ${limit} OFFSET ${offset}", 
                             ["username"=>strtolower($search)]);
    }

}



?>