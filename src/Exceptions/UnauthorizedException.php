<?php

namespace MPESA\Exceptions;

use GuzzleHttp\Exception\ClientException;

class UnauthorizedException extends \Exception{

    /**
     * Instantiate Unauthorized exception
     * 
     * @param GuzzleHttp\Exception\ClientException $e
     */
    public function __construct(ClientException $e) {
        $this->message = 'Wrong Authentication credentials provided to MPESA';
    }
    
}