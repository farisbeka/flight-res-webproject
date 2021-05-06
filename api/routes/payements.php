<?php

/**
 *     @OA\Post(path="/admin/payement", tags={"x-admin","payment"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic payment info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="payement_method", required="true", type="string", description="Method of the payment."),
 *    				 @OA\Property(property="card_number", type="integer", description="Number of the credit card."),
 *     				 @OA\Property(property="expiration_year", type="integer", description="Expiration year of the card."),
 *    				 @OA\Property(property="expiration_date", type="integer", description="Expiration date of the card."),
 *    				 @OA\Property(property="userid", type="integer", description="ID of the user."),
 * 
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Add payments for the user.")
 * )
 */ 

Flight::route('POST /admin/payement', function() {
    $data = Flight::request()->data->getData();
  Flight::json(Flight::paymentService()->insert_new_payment("payements", $data)); 
});

/**
 * @OA\Get(path="/admin/payement", tags={"x-admin","payment"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="query", name="offset", default=0, description="Offset for pagination"),
 *     @OA\Parameter(type="integer", in="query", name="limit", default=10, description="Limit for pagination"),
 *     @OA\Parameter(type="string", in="query", name="search", description="Search string for payments"),
 *     @OA\Parameter(type="string", in="query", name="order", default="-payementid", description="Sorting for return elements. -column_name ascending order by id or +column_name descending order by id"),
 *     @OA\Response(response="200", description="List payments from database")
 * )
 */ 



  Flight::route('GET /admin/payement', function() {
  
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    $order = Flight::query('order', "-payementid");
  
  
    Flight::json(Flight::paymentService()->get_payments($search, $offset, $limit, $order));
  
  });
  
  
/**
 *     @OA\Get(path="/admin/payement/{id}", tags={"x-admin","payment"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(type="integer", in="path", name="id", default=1, description="ID of payment"),
 *     @OA\Response(response="200", description="Fetch individual payment")
 * )
 */ 

  Flight::route('GET /admin/payement/@id', function($id) {
    Flight::json([Flight::paymentService()->get_payment_by_id($id)
    ]);
  });
  
  
   /**
 *     @OA\Put(path="/admin/payement/{id}", tags={"x-admin","payment"}, security={{"ApiKeyAuth":{}}},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", name="payementid", default=1),
 * @OA\RequestBody(description="Basic payment info that is going to be updated", required=true,
 *     @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
 *    				 @OA\Property(property="payement_method", required="true", type="string", description="Method of the payment."),
 *    				 @OA\Property(property="card_number", type="integer", description="Number of the credit card."),
 *     				 @OA\Property(property="expiration_year", type="integer", description="Expiration year of the card."),
 *    				 @OA\Property(property="expiration_date", type="integer", description="Expiration date of the card."),
 *    				 @OA\Property(property="userid", type="integer", description="ID of the user."),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Update payment by Payment ID from database")
 * )
 */ 


  Flight::route('PUT /admin/payement/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->update_payment($id, $data)); 
    Flight::json("Succesfully updated payment!");
  });
  

?>