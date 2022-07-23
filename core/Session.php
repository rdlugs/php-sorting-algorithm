<?php

namespace Core;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function flash(string $name, $value = null)
    {
        if (empty($name)) return;

        if (empty($value) && !empty($name))
            return $this->get($name);

        $this->set($name, $value, true);
    }

    public function set(string $name, $value, bool $isFlash = false)
    {
        if ($isFlash)
            $_SESSION['flash'][$name] = $value;
        else
            $_SESSION[$name] = $value;
    }

    public function get(string $name)
    {
        if (isset($_SESSION['flash'])) {
            if (isset($_SESSION['flash'][$name])) {
                $flash_data = $_SESSION['flash'][$name];
                return $flash_data;
            }
        } elseif (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return null;
    }

    public function unset(string $name)
    {
        unset($_SESSION[$name]);
    }

    public function clear_flash_datas()
    {
        if (isset($_SESSION['flash']))
            unset($_SESSION['flash']);
    }
}
