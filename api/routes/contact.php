<?php

/**
 *     @OA\Post(path="/contact", tags={"x-admin","contact"}, security={{"ApiKeyAuth":{}}},
 * @OA\RequestBody(description="Basic contact info", required=true,
 *     @OA\MediaType(mediaType="application/json",
 *                @OA\Schema(
 *                     @OA\Property(property="name", required="true", type="string", example="Faris", description="Name"),
 *                     @OA\Property(property="email", type="string", example="faris@bekta.me", description="E-Mail"),
 *                     @OA\Property(property="subject", type="string", example="Message", description="Message"),
 *          )
 *     )
 * ),
 *     @OA\Response(response="200", description="Message that has been added into database with ID assigned.")
 * )
 */

Flight::route('POST /contact', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::Contactservice()->insert_new_contact("contact", $data));
});
