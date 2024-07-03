<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

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
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function addWithTwoParameters()
    {
         $stringCalculator = new StringCalculator();

         $result = $stringCalculator->add("1,2");
         $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function addWithAnyParameters()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1,2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithLineBreak()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1\n2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithDifferentDelimiters()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//;\n1;2;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addShouldReciveExceptionWithNegatives()
    {
        $stringCalculator = new StringCalculator();

        $this->expectException(RuntimeException::class);
        $result = $stringCalculator->add("//;\n1;-2;3");
    }

    /**
     * @test
     */
    public function addWithNumbersHigherThan1000()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//;\n1;1001;3");
        $this->assertEquals(4, $result);
    }

    /**
     * @test
     */
    public function addWithAnyLengthDelimiter()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//[;]\n1;2;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithMultipleDelimiters()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("//[**][%]\n1*2%3");
        $this->assertEquals(6, $result);
    }
}