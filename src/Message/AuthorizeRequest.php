<?php
namespace Sproutstudioinc\Payjunction\Message;

class AuthorizeRequest extends AbstractRequest
{

    public function getStatus()
    {
        return "HOLD";
    }

    public function getAction()
    {
        return null;
    }

}
