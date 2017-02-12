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

        $yandexComission = $this->calculateComissionValue($this->getAmount());
        $amountToPay = floatval($this->getAmount()) + floatval($yandexComission);

        $data = [
            'receiver' => $this->getAccount(),
            'sum' => $amountToPay,
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

    protected function calculateComissionValue($amount)
    {
        $comission = ($amount * 0.5) / 100;
        $comission = $comission * 100;
        $comission = ceil($comission);
        $comission = $comission / 100;
        return $comission;
    }

}
