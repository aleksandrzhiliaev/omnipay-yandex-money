<?php

namespace Omnipay\YandexMoney\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class CompletePurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return true;
    }

    public function isCancelled()
    {
        return false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return null;
    }

    public function getRedirectMethod()
    {
        return null;
    }

    public function getRedirectData()
    {
        return null;
    }

    public function getTransactionId()
    {
        return intval($this->data['label']);
    }

    public function getAmount()
    {
        return floatval($this->data['amount']);
    }

    public function getMessage()
    {
        return null;
    }
}
