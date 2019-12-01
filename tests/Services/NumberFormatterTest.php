<?php

namespace App\Services\Tests;

use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class NumberFormatterTest extends TestCase
{
    /**
     * @dataProvider provideNegativeNumbers
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber
     */
    public function testThenNumberIsNegative($expectedFormattedNumber, $actualNumber)
    {
        $formatter = new NumberFormatter($actualNumber);
        $number = $formatter->formatNumber();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNegativeNumbers(): array
    {
        return [
            ['-124K', -123654.89],
        ];
    }

    /**
     * @dataProvider provideNumbersBetween0And1K
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber
     */
    public function testThenNumberIsMoreThan0AndLess1K($expectedFormattedNumber, $actualNumber)
    {
        $formatter = new NumberFormatter($actualNumber);
        $number = $formatter->formatNumber();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersBetween0And1K(): array
    {
        return [
            ['533.10', 533.1],
            ['66.67', 66.6666],
            ['12', 12.00],
            ['999.99', 999.99],
        ];
    }

    /**
     * @dataProvider provideNumbersBetween1KAnd99950
     * @param $expectedFormattedNumber
     * @param $actualNumber
     */
    public function testThenNumberIsMoreThan1KAndLessThan99950($expectedFormattedNumber, $actualNumber)
    {
        $formatter = new NumberFormatter($actualNumber);
        $number = $formatter->formatNumber();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersBetween1KAnd99950(): array
    {
        return [
            ['27 534', 27533.78],
            ['1 000', 999.9999],
        ];
    }

    /**
     * @dataProvider provideNumbersBetween99950And999500
     * @param $expectedFormattedNumber
     * @param $actualNumber
     */
    public function testThenNumberIsMoreThan99950AndLessThan999500($expectedFormattedNumber, $actualNumber)
    {
        $formatter = new NumberFormatter($actualNumber);
        $number = $formatter->formatNumber();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersBetween99950And999500(): array
    {
        return [
            ['535K', 535216],
            ['100K', 99950],
        ];
    }

    /**
     * @dataProvider provideNumbersWhichIsMoreThan999500
     * @param $expectedFormattedNumber
     * @param $actualNumber
     */
    public function testThenNumberIsMoreThan999500($expectedFormattedNumber, $actualNumber)
    {
        $formatter = new NumberFormatter($actualNumber);
        $number = $formatter->formatNumber();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersWhichIsMoreThan999500(): array
    {
        return [
            ['2.84M', 2835779],
            ['1.00M', 999500],
        ];
    }
}
