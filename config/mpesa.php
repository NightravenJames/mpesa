<?php

return [
    'username' => env('MPESA_USERNAME',null),
    'password' => env('MPESA_PASSWORD',null),

    'stk_passkey' => env('MPESA_STK_PASSKEY',null),

    'callback_url' => env('MPESA_CALLBACK_URL',null),
];