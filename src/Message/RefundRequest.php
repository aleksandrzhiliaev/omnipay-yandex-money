<?php

namespace Omnipay\YandexMoney\Message;


use Omnipay\Common\Message\AbstractRequest;
use YandexMoney\API;

class RefundRequest extends AbstractRequest
{
    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getPayeeAccount()
    {
        return $this->getParameter('payeeAccount');
    }

    public function setPayeeAccount($value)
    {
        return $this->setParameter('payeeAccount', $value);
    }

    public function getData()
    {
        $this->validate('token');

        $data['token'] = $this->getToken();
        $data['amount'] = $this->getAmount();
        $data['to'] = $this->getPayeeAccount();
        $data['comment'] = $this->getDescription();

        return $data;
    }

    public function sendData($data)
    {
        $api = new API($this->getToken());

        // make request payment
        $request = $api->requestPayment(
            [
                "pattern_id" => "p2p",
                "to" => $data['to'],
                "amount_due" => $data['amount'],
                "comment" => $data['comment'],
                "message" => $data['comment'],
                "label" => $data['comment'],
            ]
        );

        $paymentResponse = null;
        if (isset($request->request_id)) {
            $paymentResponse = $api->processPayment(["request_id" => $request->request_id]);
        }

        return $this->response = new RefundResponse($this, $paymentResponse);
    }

}
