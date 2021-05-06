<?php

require_once dirname(__FILE__)."/../dao/PayementsDao.class.php";
require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";


class PayementsService extends BaseService {

    public function __construct()
    {
        $this->dao = new PayementsDao();
    }

    public function insert_new_payment($table, $data)
    {
        return $this->dao->insert_new_payment($table, $data);
    }

    public function get_payments($id){
        return $this->dao->get_payments($id);

    }

    public function get_payment_by_id($id){
        return $this->dao->get_payment_by_id($id);

    }

    public function update_payment($payementid, $payements) {
        $this->dao->update($payementid, $payements);
    }

    


}

?>