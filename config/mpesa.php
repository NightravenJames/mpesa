<?php

return [
    'developement_mode' => env('MPESA_DEVELOPEMENT_MODE',false),

    'username' => env('MPESA_USERNAME',null),
    'password' => env('MPESA_PASSWORD',null),
    
    'paybill' => env('MPESA_PAYBILLNO',null),

    'stk_passkey' => env('MPESA_STK_PASSKEY',null),

    'callback_url' => env('MPESA_CALLBACK_URL',null),
];
