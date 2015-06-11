<?php
namespace Sproutstudioinc\Payjunction\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return !isset($this->data['error']);
    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['error']['message'];
        }

        return null;
    }

    /**
     * Get the transaction id from the response.
     *
     * Returns transaction id if the request was successful.
     *
     * @return int|null
     */
    public function getTransId()
    {

        if ($this->isSuccessful()) {
            return $this->data['transactionId'];
        }

        return null;

    }
}
