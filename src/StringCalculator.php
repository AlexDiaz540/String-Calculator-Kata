<?php

namespace Deg540\StringCalculatorPHP;

use RuntimeException;

class StringCalculator
{
    private const MAX_NUMBER = 1000;
    private const CUSTOM_DELIMITER_PREFIX = "//";

    public function add($string): int
    {
        if (empty($string)){
            return 0;
        }

        if ($this->isSingleNumber($string))
        {
            return $this->addSingleNumber($string);
        }

        if($this->hasCustomDelimiter($string)){
            $string = $this->normalizeDelimiters($string);
        }

        return $this->addMultipleNumbers($string);
    }

    public function isSingleNumber($input): bool
    {
        return count(explode(",", $input)) === 1 && !$this->hasCustomDelimiter($input);
    }

    public function isNegative(int $number): bool
    {
        return $number < 0;
    }

    public function addSingleNumber($input): int
    {
        $number = (int)$input;
        $this->validateNonNegative($number);
        return ($number > self::MAX_NUMBER) ? 0 : $number;
    }

    public function hasCustomDelimiter($string): bool
    {
        return str_starts_with($string, self::CUSTOM_DELIMITER_PREFIX);
    }

    public function normalizeDelimiters($input): string
    {
        $delimiterSectionEnd = strpos($input, "\n");
        $delimiters = substr($input, 2, $delimiterSectionEnd - 2);
        $delimiters = str_replace(['[', ']'], '', $delimiters);
        $delimitersArray = str_split($delimiters);
        $numberSection = explode("\n", $input)[1];
        foreach ($delimitersArray as $delimiter) {
            $numberSection = str_replace($delimiter, ',', $numberSection);
        }

        return $numberSection;
    }

    public function addMultipleNumbers(mixed $inputGiven): int
    {
        $inputGiven = str_replace("\n", ',', $inputGiven);
        $numbersArray = explode(",", $inputGiven);
        $total = 0;
        foreach ($numbersArray as $numberString) {
            $number = (int)$numberString;
            $this->validateNonNegative($number);
            $total += ($number > self::MAX_NUMBER) ? 0 : $number;
        }

        return $total;
    }

    public function validateNonNegative(int $number): void
    {
        if ($this->isNegative($number)) {
            throw new RuntimeException('Number must be positive');
        }
    }
}