<?php


/**
 * @OA\Get(path="/accounts",
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
 *     @OA\Get(path="/accounts/{id}",
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="List accounts by ID from database")
 * )
 */ 

  Flight::route('GET /accounts/@id', function($id) {
    Flight::json(Flight::accountService()->get_user_by_id($id));
  });


 /**
 *     @OA\Post(path="/accounts",
 *     @OA\Response(response="200", description="Add accounts in the database")
 * )
 */ 
  
  Flight::route('POST /accounts', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::accountService()->add($data)); 
  });
  

  /**
 *     @OA\Put(path="/accounts/{id}",
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
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




?>