<?php

namespace classes\interfaces;

use classes\DTO;

interface StrategyInterface
{
    /**
     * @param DTO $context
     * @return void
     */
    public function calculate(DTO $context): void;
}