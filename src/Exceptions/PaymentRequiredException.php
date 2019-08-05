<?php

namespace MPESA\Exceptions;

use GuzzleHttp\Exception\ClientException;

class PaymentRequiredException extends \Exception{
    /**
     * Instantiate Payment required exception
     * 
     * @param GuzzleHttp\Exception\ClientException $e
     */
    public function __construct(ClientException $e) {
        $this->message = 'Payment is needed by MPESA in order to complete this action';
    }
    
}