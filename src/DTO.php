<?php

namespace classes;

class DTO
{
    public int $firstNumber;
    public int $secondNumber;
    public float $total;
    public int $countIterations;
    public array $logAttempts;
    public array $logAccept;

    public function __construct()
    {
        $this->firstNumber = 0;
        $this->secondNumber = 0;
        $this->total = 0;
        $this->countIterations = 0;
        $this->logAttempts = [];
        $this->logAccept = [];
    }
}