<?php

/**
 *     @OA\Post(path="/admin/flights", tags={"x-admin","flights"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic flight info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="flight-direction", required="true", type="string", example="Paris", description="Direction of the flight."),
 *    				 @OA\Property(property="airport_id", type="integer", description="ID of the airport."),
 *     				 @OA\Property(property="flight-class", type="string", example="First class", description="Class of the flight."),
 *    				 @OA\Property(property="flight-origin", type="string", example="Origin", description="Origin of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Add Flights for the user.")
 * )
 */ 

Flight::route('POST /admin/flights', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->insert_new_flight("flights", $data)); 
  });
  
  Flight::route('GET /user/flights', function() {
  
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-flightid");
  
  
    Flight::json(Flight::flightService()->get_flights($search, $offset, $limit, $order));
  
  });
  
  
  Flight::route('GET /user/flights/@id', function($flightid) {
    Flight::json(Flight::flightService()->get_flight_by_id($flightid));
  });
  
  
  Flight::route('PUT /admin/flights/@id', function($flightid){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->update_flight($flightid, $data)); 
    Flight::json("Succesfully updated flight");
  });
  

?>