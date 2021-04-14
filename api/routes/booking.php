<?php

/**
 *     @OA\Post(path="/admin/booking", tags={"x-admin","booking"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic booking info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="flight-id", required="true", type="integer", description="ID of the flight."),
 *    				 @OA\Property(property="account-id", type="integer", description="ID of the account."),
 *     				 @OA\Property(property="payement-id", type="integer", description="ID of the payement."),
 *    				 @OA\Property(property="payement-price", type="string", description="Price of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Add Flights for the user.")
 * )
 */ 

Flight::route('POST /booking', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->insert_new_booking("booking", $data)); 
  });
  
/**
 * @OA\Get(path="/user/flights", tags={"x-user","flights"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for flights"),
 *     @OA\Parameter(type="string", in="query", name="order", default="-flightid", description="Sorting for return elements. -column_name ascending order by id or +column_name descending order by id"),
 *     @OA\Response(response="200", description="List flights from database")
 * )
 */ 



  Flight::route('GET /user/flights', function() {
  
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-flightid");
  
  
    Flight::json(Flight::flightService()->get_flights($search, $offset, $limit, $order));
  
  });
  
  
/**
 *     @OA\Get(path="/user/flights/{id}", tags={"x-user","flights"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="ID of flight"),
 *     @OA\Response(response="200", description="Fetch individual flight")
 * )
 */ 

  Flight::route('GET /user/flights/@id', function($flightid) {
    Flight::json([
      'data' => Flight::flightService()->get_flight_by_id($flightid)
    ]);
  });
  
  
  Flight::route('PUT /admin/flights/@id', function($flightid){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->update_flight($flightid, $data)); 
    Flight::json("Succesfully updated flight");
  });
  

?>