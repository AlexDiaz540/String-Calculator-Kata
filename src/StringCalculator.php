<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add($string): int
    {
        if (empty($string)){
            return 0;
        }

        if ($this->isOneParameter($string))
        {
            return (int)$string;
        }

        $numbersArray = explode(",", $string);
        $total = 0;
        foreach ($numbersArray as $numberString) {
            $total += (int)$numberString;
        }

        return $total;
    }

    public function isOneParameter($string): bool
    {
        return strlen($string) == 1;
    }
}