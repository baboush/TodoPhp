<?php

namespace App\Models;

use DateTime;

class Todo
{
    protected int $id;
    protected string $title;
    protected string $description;
    protected DateTime $dateFinish;
    protected int $state;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateFinish()
    {
        return $this->dateFinish;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function setDateFinish($date)
    {
        $this->dateFinish = $date;
        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
}
