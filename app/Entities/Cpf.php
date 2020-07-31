<?php

namespace App\Entities;

class Cpf
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function unformatted(): string
    {
        return $this->cpf;
    }

    public function formatted(): string
    {
        return $this->cpf;
    }

    public function isValid(): bool
    {
        return true;
    }
}