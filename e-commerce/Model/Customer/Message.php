<?php

namespace Model\Customer;

\Mage::loadFileByClassName('Model\Customer\Session');

class Message extends \Model\Customer\Session
{
    public function setSuccess($message)
    {
        $this->success = $message;
        return $this;
    }
    public function getSuccess()
    {
        return $this->success;
    }

    public function unsetSuccess()
    {
        unset($this->success);
        return $this;
    }

    public function setFailure($message)
    {
        $this->failure = $message;
        return $this;
    }
    public function getFailure()
    {
        return $this->failure;
    }

    public function unsetFailure()
    {
        unset($this->failure);
        return $this;
    }
}

?>