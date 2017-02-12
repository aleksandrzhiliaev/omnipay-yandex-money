<?php

namespace Omnipay\YandexMoney\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractRequest;

class CompletePurchaseRequest extends AbstractRequest
{
    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getData()
    {
        # notification_type&operation_id&amount&currency&datetime&sender&codepro&notification_secret&label
        $hash = sha1(
            $this->httpRequest->request->get('notification_type')."&".
            $this->httpRequest->request->get('operation_id')."&".
            $this->httpRequest->request->get('amount')."&".
            $this->httpRequest->request->get('currency')."&".
            $this->httpRequest->request->get('datetime')."&".
            $this->httpRequest->request->get('sender')."&".
            $this->httpRequest->request->get('codepro')."&".
            $this->getSecret()."&".
            $this->httpRequest->request->get('label')
        );

        if ($this->httpRequest->request->get('sha1_hash') != $hash) {
            throw new InvalidResponseException("Invalid hash:".$this->httpRequest->request->get('sha1_hash'));
        }

        if ($this->httpRequest->request->get('unaccepted') == 'true') {
            throw new InvalidResponseException(
                "Transaction unaccepted:".$this->httpRequest->request->get('unaccepted')
            );
        }

        if ($this->httpRequest->request->get('codepro') == 'true') {
            throw new InvalidResponseException(
                "Transaction protected by codepro:".$this->httpRequest->request->get('codepro')
            );
        }

        return $this->httpRequest->request->all();

    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

}
