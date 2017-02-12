<?php

namespace Omnipay\YandexMoney\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\YandexMoney\Support\Helpers;

class RefundResponse extends AbstractResponse
{
    protected $redirectUrl;
    protected $message;
    protected $success;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
        $this->success = false;
        $this->parseResponse($data);
    }

    public function isSuccessful()
    {
        return $this->success;
    }

    public function getMessage()
    {
        return $this->message;
    }

    private function parseResponse($data)
    {
        if ($data == null) {
            $this->success = false;
            $this->message = 'Null data, incorrect request';
            return false;
        }

        if (isset($data->status) && $data->status == 'success') {
            $this->success = true;

            return true;
        }

        $this->message = $data->error_description;
        $this->success = false;
    }

}
