<?php


Flight::route('POST /airports/addnewairport', function(){
  $data = Flight::request()->data->getData();
  Flight::airports()->insert_new_airport("airports",$data);
  Flight::json(["message" => "Successfuly added new Airport."]);
});



?>