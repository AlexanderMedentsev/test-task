<?php

namespace classes\strategies;

use classes\DTO;
use classes\interfaces\StrategyInterface;
use InvalidArgumentException;

class Subtraction implements StrategyInterface
{
    public string $name = 'вычитание';

    /**
     * @param DTO $context
     * @return void
     * @throws InvalidArgumentException
     */
    public function calculate(DTO $context): void
    {
        if ($context->total > 1000) {
            throw new InvalidArgumentException("Действие не выполнится");
        }

        $context->total = $context->firstNumber - $context->secondNumber;
    }
}