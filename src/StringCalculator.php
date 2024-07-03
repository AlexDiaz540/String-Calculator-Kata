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

        if ($this->oneParameterReceived($string))
        {
            return $this->addWithOneParameter($string);
        }

        if($this->hasDelimiters($string)){
            $string = $this->replaceDelimiters($string);
        }

        $string = str_replace("\n", ',', $string);
        $numbersArray = explode(",", $string);
        $total = 0;
        foreach ($numbersArray as $numberString) {
            $number = (int)$numberString;
            if ($this->isNegative($number)){
                throw new RuntimeException('Number must be positive');
            }
            $total += ($number > 1000) ? 0:$number;
        }

        return $total;
    }

    public function oneParameterReceived($string): bool
    {
        return count(explode(",", $string)) === 1 && !$this->hasDelimiters($string);
    }

    public function isNegative(int $number): bool
    {

        return $number < 0;
    }

    public function addWithOneParameter($string): int
    {
        $number = (int)$string;
        if ($this->isNegative($number)) {
            throw new RuntimeException('Number must be positive');
        }
        return ($number > 1000) ? 0 : $number;
    }

    public function hasDelimiters($string): bool
    {
        return str_starts_with($string, "//");
    }

    /**
     * @param $string
     * @return array|string|string[]
     */
    public function replaceDelimiters($string): string|array
    {
        $position = strpos($string, "\n");
        $delimiter = substr($string, 2, $position - 2);
        $delimiter = str_replace(['[', ']'], '', $delimiter);
        $delimiters = str_split($delimiter);
        $string = explode("\n", $string)[1];
        foreach ($delimiters as $delimiter) {
            $string = str_replace($delimiter, ',', $string);
        }
        return $string;
    }
}