<?php

namespace classes\strategies;

use classes\DTO;
use classes\interfaces\StrategyInterface;
use InvalidArgumentException;


class Addition implements StrategyInterface
{
    public string $name = 'сложение';

    /**
     * @param DTO $context
     * @return void
     * @throws InvalidArgumentException
     */
    public function calculate(DTO $context): void
    {
        if ($context->total < 0) {
            throw new InvalidArgumentException("Действие не выполнится");
        }

        $context->total = $context->firstNumber + $context->secondNumber;
    }
}