<?php

namespace Omnipay\YandexMoney\Message;

use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    public function getLabel()
    {
        return $this->getParameter('label');
    }

    public function setLabel($value)
    {
        return $this->setParameter('label', $value);
    }

    public function getPaymentType()
    {
        return $this->getParameter('paymentType');
    }

    public function setPaymentType($value)
    {
        return $this->setParameter('paymentType', $value);
    }

    public function getQuickpayForm()
    {
        return $this->getParameter('quickpayForm');
    }

    public function setQuickpayForm($value)
    {
        return $this->setParameter('quickpayForm', $value);
    }

    public function getData()
    {
        $this->validate('amount', 'account', 'transactionId');


        $data = [
            'receiver' => $this->getAccount(),
            'sum' => $this->getAmount(),
            'label' => $this->getTransactionId(),
            'formcomment' => $this->getDescription(),
            'short-dest' => $this->getDescription(),
            'comment' => $this->getDescription(),
            'paymentType' => $this->getPaymentType(),
            'quickpay-form' => $this->getQuickpayForm(),
            'targets' => $this->getTransactionId(),
        ];

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
