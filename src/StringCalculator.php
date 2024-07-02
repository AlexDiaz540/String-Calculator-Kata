<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add($string): int
    {
        if (empty($string)){
            return 0;
        }
        return $string;
    }
}