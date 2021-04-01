<?php

Flight::route('POST /flights', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->insert_new_flight("flights", $data)); 
  });
  
  Flight::route('GET /flights', function() {
  
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-flightid");
  
  
    Flight::json(Flight::flightService()->get_flights($search, $offset, $limit, $order));
  
  });
  
  
  Flight::route('GET /flights/@id', function($flightid) {
    Flight::json(Flight::flightService()->get_flight_by_id($flightid));
  });
  
  
  Flight::route('PUT /flights/@id', function($flightid){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->update_flight($flightid, $data)); 
    Flight::json("Succesfully updated flight");
  });
  

?>