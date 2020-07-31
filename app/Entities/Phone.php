<?php

namespace App\Entities;

class Phone
{
    private string $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function unformatted(): string
    {
        return $this->phone;
    }

    public function formatted(): string
    {
        return $this->phone;
    }
}