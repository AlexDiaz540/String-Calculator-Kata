<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add($string): int
    {
        if (empty($string)){
            return 0;
        }

        if (strlen($string) == 1)
        {
            return (int)$string;
        }

        $partes = explode(",", $string);
        return (int)$partes[0] + (int)$partes[1];
    }
}