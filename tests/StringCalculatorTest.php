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
    public function returnsZeroWithEmptyString(): void
    {
        $result = $this->stringCalculator->add("");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function returnsNumberWithSingleNumber(): void
    {
        $result = $this->stringCalculator->add("1");
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function returnsAddWithTwoNumbers(): void
    {
         $result = $this->stringCalculator->add("1,2");
         $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function returnsAddWithMultipleNumbers(): void
    {
        $result = $this->stringCalculator->add("1,2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function returnsSumWhenNumbersContainLineBreaks()
    {
        $result = $this->stringCalculator->add("1\n2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function returnsSumWhenUsingDifferentDelimiters()
    {
        $result = $this->stringCalculator->add("//;\n1;2;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function throwsExceptionWhenSingleNegativeNumberIsProvided()
    {
        $this->expectException(RuntimeException::class);
        $result = $this->stringCalculator->add("//;\n1;-2;3");
    }

    /**
     * @test
     */
    public function throwsExceptionWhenMultipleNegativeNumbersAreProvided()
    {
        $this->expectException(RuntimeException::class);
        $result = $this->stringCalculator->add("//;\n1;-2;3");
    }

    /**
     * @test
     */
    public function addWithOnenumberHigherThan1000()
    {
        $result = $this->stringCalculator->add("1001");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function ignoresNumbersGreaterThan1000()
    {
        $result = $this->stringCalculator->add("//;\n1;1001;3000");
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function ignoresNumbersGreaterThan1000InMultipleNumbers()
    {
        $result = $this->stringCalculator->add("//[;;]\n1;;2;;3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function supportsDelimitersOfAnyLength()
    {
        $result = $this->stringCalculator->add("//[**][%]\n1*2%3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function supportsMultipleDelimiters()
    {
        $result = $this->stringCalculator->add("//[**][%]\n1**2000%3");
        $this->assertEquals(4, $result);
    }
}