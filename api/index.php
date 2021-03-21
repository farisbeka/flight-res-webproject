
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/BookingDao.class.php";
require_once dirname(__FILE__)."/dao/AirportsDao.class.php";
require_once dirname(__FILE__)."/dao/AccountsDao.class.php";

$newinstance = new BaseDao();
$newBooking = new BookingDao();
$newAirport = new AirportsDao();
$newAccount = new AccountsDao();

$id=1;
$email="farisbeka@beka.com";

$novi_insert=[
    "id"=>"2",
    "username"=>"hanja",
    "email"=>"hanja@hanja.com",
    "password"=>"hanja"
];
$imetabele="accounts";

$zahanju = $newAccount->insert_new_account($imetabele, $novi_insert);

?>