<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*'], // '*' before ['api/*']

    'allowed_methods' => ['GET','POST','PUT', 'DELETE'], //'GET','POST','PUT','DELETE' before ['*']

    'allowed_origins' => ['*'], //'http://myapp.com' before '*'

    'allowed_origins_patterns' => [], // '/(.*)\.wip/', '/(.*)\.test/'

    'allowed_headers' => ['*'], //'content-type','accept', 'x-custome-header' before ['*']

    'exposed_headers' => ['x-custom-response-header'], //'x-custom-response-header' before []

    'max_age' => 60, // 60 before 0

    'supports_credentials' => false,

];
