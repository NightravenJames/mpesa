<?php

namespace MPESA\Exceptions;

use GuzzleHttp\Exception\ClientException;

class BadRequestException extends \Exception{
    /**
     * Instantiate Payment required exception
     * 
     * @param GuzzleHttp\Exception\ClientException $e
     */
    public function __construct(ClientException $e) {
        $this->message = $e->getResponse()->getBody()->getContents();
    }
    
}