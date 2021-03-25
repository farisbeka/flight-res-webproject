<?php

Flight::route('GET /accounts', function() {

    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);

    $search = Flight::query('search');

    if($search) {
        Flight::json(Flight::accounts()->get_accounts($search, $offset, $limit));

    } else {
        Flight::json(Flight::accounts()->get_all($offset,$limit));
    }

    Flight::json(Flight::accounts()->get_all($offset,$limit));
  });

  
  Flight::route('GET /accounts/@id', function($id) {
    Flight::json(Flight::accounts()->get_user_by_id($id));
  });

  
  Flight::route('POST /accounts', function() {
    $request = Flight::request();
    $data = $request->data->getData();
    $account = Flight::accounts()->add($data);
    Flight::json($account); 
  });
  

  Flight::route('PUT /accounts/@id', function($id){
    $request = Flight::request();
    $data = $request->data->getData();
    Flight::accounts()->update($id, $data);
    $account = Flight::accounts()->get_user_by_id($id);
    Flight::json($account); 
  });

?>