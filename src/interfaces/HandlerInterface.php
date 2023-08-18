<?php

namespace classes\interfaces;

use classes\DTO;

interface HandlerInterface
{
    /**
     * @param DTO $context
     * @return void
     */
    public function handle(DTO $context): void;
}