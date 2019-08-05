<?php

namespace MPESA\Traits;

trait PayOnline {
    public $accountReference,$transactionDesc;
    public function initiateSTKCheckout(float $amount,string $partyA)
    {
        return $this->post('v1/processrequest',[
            'json' => [
                'BusinessShortCode' => $this->partyB,
                'Password' => base64_encode($this->partyB.$this->passKey.$this->timestamp),
                'Timestamp' => $this->timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $partyA,
                'PartyB' => $this->partyB,
                'PhoneNumber' => $partyA,
                'CallBackURL' => $this->callBackURL,
                'AccountReference' => $this->accountReference??'AccountReference',
                'TransactionDesc' => $this->transactionDesc??'TransactionDesc'
            ],
        ]);
    }
}