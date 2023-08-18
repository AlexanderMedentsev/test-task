<?php

namespace classes;

use classes\interfaces\HandlerInterface;
use classes\strategies\Addition;
use classes\strategies\Division;
use classes\strategies\Multiplication;
use classes\strategies\Subtraction;
use InvalidArgumentException;

class Handler implements HandlerInterface
{
    private array $manipulations;
    private array $logManipulation;
    private array $logResult;
    private array $logTotal;
    private int $badTry;

    public function handle(DTO $context): void
    {
        while (empty($context->logAccept) || count($context->logAttempts) <= 6) {
            $context->total = 0;
            $this->manipulations = [new Addition(), new Division(), new Multiplication(), new Subtraction()];
            $this->badTry = 0;
            $this->logManipulation = [];
            $this->logResult = [];
            $this->logTotal = [];
            $this->logTotal[] = 0;
            shuffle($this->manipulations);

            $this->select($context);

            $context->countIterations++;

            $this->saveLogs($context);

            if ($context->countIterations > 30) {
                break;
            }
        }
    }

    private function select(DTO $context): void
    {
        foreach ($this->manipulations as $manipulation) {
            try {
                $manipulation->calculate($context);
                $this->logger($manipulation->name, $context->total);
            } catch (InvalidArgumentException) {
                $this->badTry++;
            }
        }
    }

    private function logger(string $manipulation, float|int $result): void
    {
        $this->logManipulation[] = $manipulation;
        $this->logResult[] = $result;
        $this->logTotal[] = $result;
    }

    private function saveLogs(DTO $context): void
    {
        if ($this->badTry != 0 && $this->badTry <= count($this->manipulations)) {
            $context->logAttempts[] = array_column($this->manipulations, 'name');
        }

        if ($this->badTry == 0) {
            array_pop($this->logTotal);
            for ($i = 0; $i < count($this->manipulations); $i++) {
                $context->logAccept[$i] = [$this->logTotal[$i], $this->logManipulation[$i], $this->logResult[$i]];
            }
        }
    }
}