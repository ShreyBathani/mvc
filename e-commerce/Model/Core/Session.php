<?php

namespace Model\Core;

class Session
{
    protected $nameSpace = null;

    public function __construct() {
        $this->nameSpace = 'core';
        $this->start();
    }

    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    public function getNamespace()
    {
        return $this->nameSpace;
    }

    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $this;
    }

    public function destroy()
    {
        session_destroy();
        return $this;
    }

    public function getId()
    {
        return session_id();
    }

    public function regeneratedId()
    {
        return session_regenerate_id();
    }

    public function __set($key, $value)
    {
        $_SESSION[$this->getNamespace()][$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (!array_key_exists($this->getNamespace(), $_SESSION)) {
            return null;
        }
        if (!array_key_exists($key, $_SESSION[$this->getNamespace()])) {
            return null;
        }
        return $_SESSION[$this->getNamespace()][$key];
    }

    public function __unset($key)
    {
        if (array_key_exists($key, $_SESSION[$this->getNamespace()])) {
            unset($_SESSION[$this->getNamespace()][$key]);
        }
        return $this;
    }
}


?>