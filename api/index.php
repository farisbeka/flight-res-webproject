
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/BookingDao.class.php";
require_once dirname(__FILE__)."/dao/AirportsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/services/AccountService.class.php";


Flight::set('flight.log_errors', TRUE);

 /**Error handling for our API */
 Flight::map('error', function(Exception $ex) {
   //header("Content-type: application/json");
   //Flight::halt($ex->getCode(), json_encode(["message" => $ex->getMessage()]));

   Flight::json(["message" => $ex->getMessage()],$ex->getCode());
 });


/**
 * utility func for reading query parameters from url
 */
Flight::map('query', function($name, $default_value=NULL) {
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return $query_param;

});
/**Include all routes */
require_once dirname(__FILE__)."/routes/accounts.php";
require_once dirname(__FILE__)."/routes/airports.php";

//$newinstance = new BaseDao();
//$newBooking = new BookingDao();
//$newAccount = new AccountsDao();
$newAirport = new AirportsDao();


Flight::register("airports", "AirportsDao");
/**Register business logic layer */
Flight::register("accountService","AccountService");



Flight::start();


//test to insert acc
/*$novi_insert=[
    "id"=>"4",
    "username"=>"dino",
    "email"=>"dino@bektas.ch",
    "password"=>"dinoxd"
];
$imetabele="accounts";

$zahanju = $newAccount->insert_new_account($imetabele, $novi_insert);*/
  


//test to get all accs
/*$dao = new AccountsDao();
$accounts = $dao->get_all_accounts();
print_r($accounts);*/

/*$dao = new AccountsDao();
$accounts = $dao->get_all($_GET['offset'], $_GET['limit']);
print_r($accounts);*/


?>