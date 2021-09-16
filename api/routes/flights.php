<?php

/**
 *     @OA\Post(path="/admin/flights", tags={"x-admin","flights"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic flight info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *                @OA\Schema(
 *                     @OA\Property(property="flight_direction", required="true", type="string", example="Paris", description="Direction of the flight."),
 *                     @OA\Property(property="airport_id", type="integer", description="ID of the airport."),
 *                      @OA\Property(property="flight_class", type="string", example="First class", description="Class of the flight."),
 *                     @OA\Property(property="flight_origin", type="string", example="Origin", description="Origin of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Add Flights for the user.")
 * )
 */

Flight::route('POST /flights', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->insert_new_flight("flights", $data));
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

Flight::route('GET /user/flights', function () {

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

Flight::route('GET /user/flights/@id', function ($flightid) {
    Flight::json([
        'data' => Flight::flightService()->get_flight_by_id($flightid),
    ]);
});

/**
 *     @OA\Put(path="/admin/flights/{id}", tags={"x-admin","flights"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 * @OA\RequestBody(description="Basic flight info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *                @OA\Schema(
 *                     @OA\Property(property="flight_direction", required="true", type="string", example="Paris", description="Direction of the flight."),
 *                     @OA\Property(property="airport_id", type="integer", description="ID of the airport."),
 *                      @OA\Property(property="flight_class", type="string", example="First class", description="Class of the flight."),
 *                     @OA\Property(property="flight_origin", type="string", example="Origin", description="Origin of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Update flight by ID from database")
 * )
 */

Flight::route('PUT /admin/flights/@id', function ($flightid) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::flightService()->update_flight($flightid, $data));
    Flight::json("Succesfully updated flight");
});

/**
 *     @OA\Delete(path="/admin/airports/{id}", tags={"x-user","airports"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="ID of airport"),
 *     @OA\Response(response="200", description="Fetch individual airport")
 * )
 */

Flight::route('DELETE /admin/flights/@id', function ($id) {
    Flight::json(Flight::flightService()->delete_flight($id));
});
