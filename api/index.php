
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/BookingDao.class.php";
require_once dirname(__FILE__)."/dao/AirportsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";
require_once dirname(__FILE__)."/routes/AccountRoutes.php";

//$newinstance = new BaseDao();
//$newBooking = new BookingDao();
//$newAccount = new AccountsDao();
$newAirport = new AirportsDao();


Flight::register("accounts","AccountsDao");
Flight::register("airports", "AirportsDao");

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /accounts', function() {
  Flight::json(Flight::accounts()->get_all());
});

Flight::route('GET /accounts/@id', function($id) {
  Flight::json(Flight::accounts()->get_user_by_id($id));
});

Flight::route('POST /accounts', function() {
  $request = Flight::request();
  $data = $request->data->getData();
  
  $account = Flight::accounts()->add($data);


  Flight::json($account); 
});

Flight::route('PUT /accounts/@id', function($id){
  
  
  $request = Flight::request();
  $data = $request->data->getData();

  Flight::accounts()->update($id, $data);

  $account = Flight::accounts()->get_user_by_id($id);
  Flight::json($account); 
});

/*Flight::route('GET /accounts', function(){
  $dao = new AccountsDao();
  $accounts = $dao->get_all();    
  Flight::json($accounts);
});*/

/*Flight::route('GET /accounts/allaccount', function(){
  $acc = new AccountsDao();
  Flight::json($acc->get_all_accounts());

});*/



Flight::start();


//$id=1;
//$email="farisbeka@beka.com";


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