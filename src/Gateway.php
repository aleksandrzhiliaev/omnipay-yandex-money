<?php

namespace Omnipay\YandexMoney;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'YandexMoney';
    }

    public function getAccount()
    {
        return $this->getParameter('account');
    }

    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
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

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getDefaultParameters()
    {
        return array(
            'receiver' => '',
        );
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\YandexMoney\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\YandexMoney\Message\CompletePurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\YandexMoney\Message\RefundRequest', $parameters);
    }
}
