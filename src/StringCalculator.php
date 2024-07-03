<?php

namespace Deg540\StringCalculatorPHP;

use RuntimeException;

class StringCalculator
{
    public function add($string): int
    {
        if (empty($string)){
            return 0;
        }

        if ($this->isOneParameter($string))
        {
            $number = (int)$string;
            if($this->isNegative($number)){
                throw new RuntimeException('Number must be positive');
            }
            $number = ($number > 1000) ? 0:$number;
            return $number;
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
            $number = (int)$numberString;
            if ($this->isNegative($number)){
                throw new RuntimeException('Number must be positive');
            }
            $total += $number;
        }

        return $total;
    }

    public function isOneParameter($string): bool
    {
        return count(explode(",", $string)) === 1 && !str_starts_with($string, "//");
    }

    public function isNegative(int $number): bool
    {

        return $number < 0;
    }
}