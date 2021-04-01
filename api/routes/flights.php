<?php

Flight::route('POST /flights', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::Airportsservice()->insert_new_airport("airports", $data)); 
  });
  
  Flight::route('GET /flights', function() {
  
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-airportid");
  
  
    Flight::json(Flight::flightService()->get_airports($search, $offset, $limit, $order));
  
  });
  
  
  Flight::route('GET /airports/@id', function($airportid) {
    Flight::json(Flight::Airportsservice()->get_airport_by_id($airportid));
  });
  
  
  Flight::route('PUT /airports/@id', function($airportid){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::Airportsservice()->update_airport($airportid, $data)); 
    Flight::json("Succesfully updated airport");
  });
  

?>