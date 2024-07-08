<?php

namespace App\Models;

class User
{
    protected int $id;
    protected string $pseudo;
    protected string $password;

    public function __construct(string $pseudo, string $password)
    {
        $this->pseudo = $pseudo;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}
