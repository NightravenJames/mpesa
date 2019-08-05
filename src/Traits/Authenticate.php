<?php

namespace MPESA\Traits;

trait Authenticate{
    public function generateToken()
    {
        return $this->get('generate',[
            'auth' => [$this->username, $this->password],
            'query' => [
                'grant_type'=>'client_credentials'
            ]
        ]);
    }
}