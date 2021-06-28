<?php

/**
 *     @OA\Post(path="/user/booking", tags={"x-user","booking"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic booking info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *                @OA\Schema(
 *                     @OA\Property(property="flight_id", required="true", type="integer", description="ID of the flight."),
 *                     @OA\Property(property="account_id", type="integer", description="ID of the account."),
 *                      @OA\Property(property="payement_id", type="integer", description="ID of the payement."),
 *                     @OA\Property(property="payement_price", type="string", description="Price of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Add Flights for the user.")
 * )
 */

Flight::route('POST /user/booking', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->insert_new_booking("booking", $data));
});

/**
 * @OA\Get(path="/admin/booking", tags={"x-admin","booking"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for bookings"),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by id or +column_name descending order by id"),
 *     @OA\Response(response="200", description="List bookings from database")
 * )
 */

Flight::route('GET /admin/booking', function () {

    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-id");

    Flight::json(Flight::bookingService()->get_booking($search, $offset, $limit, $order));

});

/**
 *     @OA\Get(path="/admin/booking/{id}", tags={"x-admin","booking"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="ID of booking"),
 *     @OA\Response(response="200", description="Fetch individual booking")
 * )
 */

Flight::route('GET /admin/booking/@id', function ($id) {
    Flight::json([Flight::bookingService()->get_booking_by_id($id),
    ]);
});

/**
 *     @OA\Put(path="/user/booking/{id}", tags={"x-user","booking"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 * @OA\RequestBody(description="Basic booking info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *                @OA\Schema(
 *                     @OA\Property(property="flight_id", required="true", type="integer", description="ID of the flight."),
 *                     @OA\Property(property="account_id", type="integer", description="ID of the account."),
 *                      @OA\Property(property="payement_id", type="integer", description="ID of the payement."),
 *                     @OA\Property(property="payement_price", type="integer", description="Price of the flight."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Update booking by ID from database")
 * )
 */

Flight::route('PUT /user/booking/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::bookingService()->update_booking($id, $data));
    Flight::json("Succesfully updated booking");
});
