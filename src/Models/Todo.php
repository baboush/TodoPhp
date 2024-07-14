<?php

namespace App\Models;

use DateTime;

class Todo
{
    protected ?int $id;
    protected string $title;
    protected string $message;
    protected ?DateTime $dateFinish;
    protected int $state;
    protected DateTime $createAt;
    protected int $userId;


    public function __construct(?int $id = null, ?int $userId = 0, ?string $title = '', ?string $message = '', ?DateTime $dateFinish = null, ?DateTime $createAt = null, ?int $state = 0)
    {
        $this->title = $title;
        $this->message = $message;
        $this->dateFinish = $dateFinish;
        $this->createAt = $createAt ?? new DateTime();
        $this->state = $state;
        $this->userId = $userId;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getDateFinish()
    {
        return $this->dateFinish;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCreateAt()
    {
        return $this->createAt;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function setDateFinish(?DateTime $date)
    {
        $this->dateFinish = $date;
        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function setCreateAt()
    {
        $this->createAt = new DateTime();
        return $this;
    }
}
