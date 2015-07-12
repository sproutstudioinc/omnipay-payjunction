<?php
namespace Omnipay\Payjunction\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.payjunction.com';
    protected $testEndpoint = 'https://api.payjunctionlabs.com';

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

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            null,
            $data
        );

        $httpResponse = $httpRequest
            ->setHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->setHeader('Authorization', 'Basic ' . base64_encode($this->getApiLogin() . ':' . $this->getApiPassword()))
            ->setHeader('X-PJ-Application-Key', $this->getAppKey())
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }

    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function getCardData()
    {
        $this->getCard()->validate();

        $card = array();
        $card['cardNumber'] = $this->getCard()->getNumber();
        $card['cardExpMonth'] = $this->getCard()->getExpiryDate('m');
        $card['cardExpYear'] = $this->getCard()->getExpiryDate('Y');
        $card['cardCvv'] = $this->getCard()->getCvv();

        return $card;
    }

    public function getData()
    {

        $this->validate('amount');

        //map card to upper level
        $data = $this->getCardData();
        $data['amountBase'] = $this->getAmount();

        if (!is_null($this->getStatus())) {
            $data['status'] = $this->getStatus();
        }

        if (!is_null($this->getAction())) {
            $data['action'] = $this->getAction();
        }

        return $data;
    }

    public function getStatus()
    {
        return null;
    }

    /**
     * Default for PayJunction
     */
    public function getAction()
    {
        return "CHARGE";
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase() . '/transactions';
    }

}
