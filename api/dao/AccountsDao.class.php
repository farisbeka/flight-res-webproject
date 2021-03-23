<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

$tablename="accounts";

class AccountsDao extends BaseDao {

    

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

}



?>