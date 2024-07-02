<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function addWhenStringIsEmpty()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function addWhithOneParameter()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1");
        $this->assertEquals(0, $result);
    }
}