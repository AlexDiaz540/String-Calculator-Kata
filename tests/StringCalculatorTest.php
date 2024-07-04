<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;
    protected function setUp(): void
    {
        $this->stringCalculator = new StringCalculator();
    }
    /**
     * @test
     */
    public function addWhenStringIsEmpty()
    {
        $result = $this->stringCalculator->add("");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function addWhithOneParameter()
    {
        $result = $this->stringCalculator->add("1");
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function addWithTwoParameters()
    {
         $result = $this->stringCalculator->add("1,2");
         $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function addWithAnyParameters()
    {
        $result = $this->stringCalculator->add("1,2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithLineBreak()
    {
        $result = $this->stringCalculator->add("1\n2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithDifferentDelimiters()
    {
        $result = $this->stringCalculator->add("//;\n1;2;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addShouldReciveExceptionWithOneNegativeParameter()
    {
        $this->expectException(RuntimeException::class);
        $result = $this->stringCalculator->add("//;\n1;-2;3");
    }

    /**
     * @test
     */
    public function addShouldReciveExceptionWithAnyNegativesParameters()
    {
        $this->expectException(RuntimeException::class);
        $result = $this->stringCalculator->add("//;\n1;-2;3");
    }

    /**
     * @test
     */
    public function addWithOneParameterHigherThan1000()
    {
        $result = $this->stringCalculator->add("1001");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function addWithParametersHigherThan1000()
    {
        $result = $this->stringCalculator->add("//;\n1;1001;3000");
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function addWithAnyLengthDelimiter()
    {
        $result = $this->stringCalculator->add("//[;;]\n1;;2;;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithMultipleDelimiters()
    {
        $result = $this->stringCalculator->add("//[**][%]\n1*2%3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function addWithMultipleDelimitersAndParameterHigherThan1000()
    {
        $result = $this->stringCalculator->add("//[**][%]\n1**2000%3");
        $this->assertEquals(4, $result);
    }
}