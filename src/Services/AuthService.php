<?php

namespace MPESA\Services;

use GuzzleHttp\Client;
use MPESA\Exceptions\BadRequestException;
use GuzzleHttp\Exception\ClientException;
use MPESA\Exceptions\PaymentRequiredException;
use MPESA\Exceptions\UnauthorizedException;
use MPESA\Traits\Authenticate;

class AuthService {
    use Authenticate;

    private $username,$password,$client;

    /**
     * Instatiate with credentials
     */
    public function __construct($username,$password) {
        $this->username = $username;
        $this->password = $password;
        $this->client = new Client([
            'base_uri' => 'https://sandbox.safaricom.co.ke/oauth/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Send get request
     * 
     * @param string $route
     */
    protected function get(string $route,array $data)
    {
        return self::process('GET',$route,$data);
    }

    /**
     * Send post request
     * 
     * @param string $route,@param string $data
     */
    protected function post(string $route,array $data)
    {
        return self::process('POST',$route,$data);
    }

    /**
     * Process request
     * 
     * @param string $method,@param string $route,@param array $data
     */
    protected function process(string $method,string $route,array $data = [])
    {
        try{
            $response = $this->client->request($method,$route,$data);
            
            return json_decode($response->getBody());
        }catch(ClientException $e){
            $status_code = $e->getResponse()->getStatusCode();

            if($status_code == 401)
                throw new UnauthorizedException($e);
            elseif($status_code == 402)
                throw new PaymentRequiredException($e);
            elseif($status_code == 400)
                throw new BadRequestException($e);
        }
    }

}