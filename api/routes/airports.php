<?php


Flight::route('POST /admin/airports', function() {
  $data = Flight::request()->data->getData();
  Flight::json(Flight::Airportsservice()->insert_new_airport("airports", $data)); 
});

/**
 * @OA\Get(path="/user/airports", tags={"x-user","airports"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for airports"),
 *     @OA\Parameter(type="string", in="query", name="order", default="-airportid", description="Sorting for return elements. -column_name ascending order by id or +column_name descending order by id"),
 *     @OA\Response(response="200", description="List airports from database")
 * )
 */ 


Flight::route('GET /user/airports', function() {

  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 10);
  $search = Flight::query('search');
  $order = Flight::query('order', "-airportid");


  Flight::json(Flight::Airportsservice()->get_airports($search, $offset, $limit, $order));

});


/**
 *     @OA\Get(path="/user/airports/{id}", tags={"x-user","airports"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="airportid", default=1, description="ID of airport"),
 *     @OA\Response(response="200", description="Fetch individual airport")
 * )
 */ 

Flight::route('GET /user/airports/@id', function($airportid) {
  Flight::json(Flight::Airportsservice()->get_airport_by_id($airportid));
});



Flight::route('PUT /admin/airports/@id', function($airportid){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::Airportsservice()->update_airport($airportid, $data)); 
  Flight::json("Succesfully updated airport");
});


?>