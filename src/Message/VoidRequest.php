<?php
namespace Sproutstudioinc\Payjunction\Message;

class VoidRequest extends AbstractRequest
{

    public function getStatus()
    {
        return "VOID";
    }

    public function getHttpMethod()
    {
        return 'PUT';
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase() . '/transactions/' . $this->getTransactionId();
    }

}
