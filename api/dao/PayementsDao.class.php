<?php


require_once dirname(__FILE__)."/BaseDao.class.php";

class PayementsDao extends BaseDao {

    public function __construct()
    {
        parent::__construct("payements");
    }


    public function return_payement_by_id($id)
    {
        return $this->query_unique("SELECT * FROM payements WHERE payementid=:id", ["id" => $id]);
    }

    public function return_payement_by_cardnum($cardnum)
    {
        return $this->query_unique("SELECT * FROM payements WHERE card_number=cardnum", ["cardnum => $cardnum"]);
    }


}

?>