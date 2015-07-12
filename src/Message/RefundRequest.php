<?php
namespace Omnipay\Payjunction\Message;

class RefundRequest extends AbstractRequest
{

    public function getAction()
    {
        return "REFUND";
    }

}
