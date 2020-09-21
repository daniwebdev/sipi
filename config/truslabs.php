<?php

return [
    'version'       => env('APP_VERSION', '1.0.0'),
    'force-https'   => !env('APP_DEBUG', true),
    'logo-url'      => '',
    'default-page'  => 'welcome',

    'jwt_key' => env('APP_KEY', md5('secret'))
];