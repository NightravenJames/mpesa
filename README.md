# Laravel MPESA

### Introduction 

This package is still under developement. A full and descriptive documentation is coming soon. Work with the functionality under the table of contents for now

**Contents**
- [Installation](#installation)
- [STK-Push](#stk-push)


---

## Installation
1. Run the following command to install:
`composer require nevar/mpesa:v1.0-stable`

2. If you are using older versions of _Laravel 5_ be sure to include the following provivers in your _*app/config.php*_

```php
<?php

return [
    'providers' => [
        /*
         * Package Service Providers...
         */

        MPESA\Providers\AuthServiceProvider::class,
        MPESA\Providers\ConfigurationServiceProvider::class,
        MPESA\Providers\OnlinePaymentServiceProvider::class,
    ]
];

```
3. Then run `php artisan vendor:publish --tag=mpesa-config`

4. Add the following values to you _*.env*_ file

```php
MPESA_DEVELOPEMENT_MODE=true
MPESA_USERNAME=m&yu$ern@ame
MPESA_PASSWORD=password
MPESA_PAYBILLNO=0000
MPESA_STK_PASSKEY=000c2daf998f92aa5a925350031f2471f873bff7877879b45cc364f2cb9a9907ef1245
MPESA_CALLBACK_URL= http://5c3f4b1d.ngrok.io/api/mpesa/callback

```

5. `MPESA_DEVELOPEMENT_MODE` should be false if in production otherwise leave it as true

6. If you're developing login and get test credentials from [here](https://developer.safaricom.co.ke/test_credentials) so as to populate your environment variables.

## STK-Push

1. Below is a use case on how to request for payment via STK-Push. 

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use MPESA\Services\OnlinePaymentService;

class PaymentController extends Controller
{
    public function requestPayment(Request $request,OnlinePaymentService $stk)
    {
        // phone number
        $user_phone_number = "254712345678";
        $amount = 50;

        // this is optional if you want to overide the IPN on your .env
        $stk->callBackURL = "http://8bbea5f4.ngrok.io/api/mpesa/response-callback";
        
        // request for payment
        $stk->initiateSTKCheckout($amount,$user_phone_number);

    }
}
```

2. Set up your call back incase of successfull or cancelled payments . Your callback url should match the .env variable `MPESA_CALLBACK_URL` or `$stk->callBackURL` override. For more information on the json response from MPESA visit [here](https://developer.safaricom.co.ke/docs?json#lipa-na-m-pesa-online-payment)

3. Otherwise here is a sample of the IPN callback

```json
 // A cancelled request
  {
    "Body":{
      "stkCallback":{
        "MerchantRequestID":"8555-67195-1",
        "CheckoutRequestID":"ws_CO_27072017151044001",
        "ResultCode":1032,
        "ResultDesc":"[STK_CB - ]Request cancelled by user"
      }
    }
  }
  
  // An accepted request
  {
    "Body":{
      "stkCallback":{
        "MerchantRequestID":"19465-780693-1",
        "CheckoutRequestID":"ws_CO_27072017154747416",
        "ResultCode":0,
        "ResultDesc":"The service request is processed successfully.",
        "CallbackMetadata":{
          "Item":[
            {
              "Name":"Amount",
              "Value":1
            },
            {
              "Name":"MpesaReceiptNumber",
              "Value":"LGR7OWQX0R"
            },
            {
              "Name":"Balance"
            },
            {
              "Name":"TransactionDate",
              "Value":20170727154800
            },
            {
              "Name":"PhoneNumber",
              "Value":254721566839
            }
          ]
        }
      }
    }
  }
```

*NB* Create an issue incase of any problems.
