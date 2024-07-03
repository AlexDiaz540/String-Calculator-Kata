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

        if(str_starts_with($string, "//")){
            $delimiter = substr($string, 2, 1);
            $string = explode("\n", $string);
            $string = str_replace($delimiter, ',', $string[1]);
        }

        $string = str_replace("\n", ',', $string);
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