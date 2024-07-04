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

        return $this->addWithTwoOrMoreParameters($string);
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

    public function replaceDelimiters($inputGiven): string|array
    {
        $lineBreakPosition = strpos($inputGiven, "\n");
        $delimiters = substr($inputGiven, 2, $lineBreakPosition - 2);
        $delimiters = str_replace(['[', ']'], '', $delimiters);
        $delimitersArray = str_split($delimiters);
        $parameters = explode("\n", $inputGiven)[1];
        foreach ($delimitersArray as $delimiter) {
            $parameters = str_replace($delimiter, ',', $parameters);
        }
        return $parameters;
    }

    public function addWithTwoOrMoreParameters(mixed $inputGiven): int
    {
        $inputGiven = str_replace("\n", ',', $inputGiven);
        $numbersArray = explode(",", $inputGiven);
        $total = 0;
        foreach ($numbersArray as $numberString) {
            $number = (int)$numberString;
            if ($this->isNegative($number)) {
                throw new RuntimeException('Number must be positive');
            }
            $total += ($number > 1000) ? 0 : $number;
        }
        return $total;
    }
}