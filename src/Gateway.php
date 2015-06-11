<?php
namespace Sproutstudioinc\Payjunction;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Payjunction';
    }
    public function getDefaultParameters()
    {
        return array(
            'apiLogin' => '',
            'apiPassword' => '',
        );
    }

    public function getAppKey()
    {
        return $this->getParameter('appKey');
    }

    public function setAppKey($value)
    {
        return $this->setParameter('appKey', $value);
    }

    public function getApiLogin()
    {
        return $this->getParameter('apiLogin');
    }

    public function setApiLogin($value)
    {
        return $this->setParameter('apiLogin', $value);
    }

    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    /**
     * @param array $parameters
     * @return \Sproutstudioinc\Payjunction\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Sproutstudioinc\Payjunction\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Sproutstudioinc\Payjunction\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Sproutstudioinc\Payjunction\Message\CaptureRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Sproutstudioinc\Payjunction\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Sproutstudioinc\Payjunction\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Sproutstudioinc\Payjunction\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Sproutstudioinc\Payjunction\Message\RefundRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Sproutstudioinc\Payjunction\Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Sproutstudioinc\Payjunction\Message\VoidRequest', $parameters);
    }

}
