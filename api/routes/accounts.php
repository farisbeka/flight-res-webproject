<?php

/**Swagger Documentation */

/**
 * @OA\Info(title="flight-reservation API", version="0.1")
 * @OA\OpenApi(
 *   @OA\Server(
 *       url="http://localhost/flight-reservation/api/",
 *       description="Development Environment"
 *   )
 * )
 */


/**
 * @OA\Get(path="/accounts", tags={"account"},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for accounts"),
 *     @OA\Parameter(type="string", in="query", name="order", default="-id", description="Sorting for return elements. -column_name ascending order by id or +column_name descending order by id"),
 *     @OA\Response(response="200", description="List accounts from database")
 * )
 */ 


Flight::route('GET /accounts', function() {

    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');

    $order = Flight::query('order', "-id");


    Flight::json(Flight::accountService()->get_accounts($search, $offset, $limit, $order));

  });

  
  /**
 *     @OA\Get(path="/accounts/{id}", tags={"account"},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1, description="ID of account"),
 *     @OA\Response(response="200", description="Fetch individual account")
 * )
 */ 

  Flight::route('GET /accounts/@id', function($id) {
    Flight::json(Flight::accountService()->get_user_by_id($id));
  });


 /**
 *     @OA\Post(path="/accounts", tags={"account"},
 * @OA\RequestBody(description="Basic account info", required=true
 *     @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="Beka", description="Name of the account"),
 *    				 @OA\Property(property="email", type="string", example="faris@bekta.me", description="Email of the account"),
 *    				 @OA\Property(property="password", type="string", example="", description="Password of the account"),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Account that has been added into database with ID assigned.")
 * )
 */ 
  
  Flight::route('POST /accounts', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accountService()->add($data)); 
  });
  

  /**
 *     @OA\Put(path="/accounts/{id}", tags={"account"},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="id", default=1),
 * @OA\RequestBody(description="Basic account info that is going to be updated", required=true
 *     @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="username", required="true", type="string", example="Beka", description="Name of the account"),
 *    				 @OA\Property(property="email", type="string", example="faris@bekta.me", description="Email of the account"),
 *    				 @OA\Property(property="password", type="string", example="", description="Password of the account"),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Update accounts by ID from database")
 * )
 */ 

  Flight::route('PUT /accounts/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accountService()->update($id, $data)); 
  });


  Flight::route('POST /accounts/register', function() {
    $data = Flight::request()->data->getData();
    Flight::accountService()->register($data);
    Flight::json(".."); 
  });

  Flight::route('GET /accounts/confirm/@token', function($token){
  Flight::accountService()->confirm($token);
  Flight::json(["message" => "Your account has been activated!"]);
  });




?>