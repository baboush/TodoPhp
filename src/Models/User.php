<?php

namespace App\Models;

class User
{
    protected int $id;
    protected string $login;
    protected string $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
        return $this;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}
