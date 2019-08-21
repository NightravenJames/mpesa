<?php

namespace MPESA\Services;

use GuzzleHttp\Client;
use MPESA\Facades\Auth;
use MPESA\Traits\PayOnline;
use MPESA\Exceptions\BadRequestException;
use GuzzleHttp\Exception\ClientException;
use MPESA\Exceptions\PaymentRequiredException;
use MPESA\Exceptions\UnauthorizedException;

class OnlinePaymentService {
    use PayOnline;
    private $access_token;
    public $partyB, $callBackURL,$passkey;
    /**
     * Instatiate with token
     * 
     * @param string $username,@param string $api_key
     */
    public function __construct($base_uri) {
        $this->access_token = Auth::generateToken()->access_token;
        $this->client = new Client([
            'base_uri' => $base_uri,
            'headers' => [
                'Authorization' => "Bearer {$this->access_token}",
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
    public function post(string $route,array $data)
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
            else
                dd($e);
        }
    }

}