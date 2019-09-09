<?php
/**
 * Created by PhpStorm.
 * User: MyoThantKyaw
 * Date: 09/09/19
 * Time: 13:33
 */

return [
    /*
    |--------------------------------------------------------------------
    | Api Headers
    |--------------------------------------------------------------------
    |
    | This feature used to authorize for authentication.
    | You must be use this feature.
    | Because all of api request are only allowed for authenticate user.
    |
    |--------------------------------------------------------------------
    */

    "headers" => [
        "key" => "x-api-key",
        "secret" => "x-api-secret",
        "secure_key" => "x-secure-key"
    ],

    /*
    |--------------------------------------------------------------------
    | Algorithm
    |--------------------------------------------------------------------
    |
    | This feature used to hash key.
    |
    |--------------------------------------------------------------------
    */

    "algorithm" => [
        "sha256", "sha512", "sha356", "sha1"
    ]
];