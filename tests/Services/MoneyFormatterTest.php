<?php

namespace App\Services\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{
    private $mock;

    protected function setUp()
    {
        $this->mock = $this->getNumberFormatterMock();
    }

    /**
     * @dataProvider provideNumbersForEuroFormat
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber
     */
    public function testIfReturnEuroFormat($expectedFormattedNumber, $actualNumber)
    {
        $this->mock->method('formatNumber')
            ->with($actualNumber)
            ->willReturn($expectedFormattedNumber);

        $formatter = new MoneyFormatter($actualNumber);
        $number = $formatter->formatEur();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersForEuroFormat(): array
    {
        return [
            ['2.84M €', 2835779],
            ['211.99 €', 211.99]
        ];
    }
    /**
     * @dataProvider provideNumbersForUsdFormat
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber
     */
    public function testIfReturnUsdFormat($expectedFormattedNumber, $actualNumber)
    {
        $this->mock->method('formatNumber')
            ->with($actualNumber)
            ->willReturn($expectedFormattedNumber);

        $formatter = new MoneyFormatter($actualNumber);
        $number = $formatter->formatUsd();

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersForUsdFormat(): array
    {
        return [
            ['$2.84M', 2835779],
            ['$211.99', 211.99],
        ];
    }
    private function getNumberFormatterMock()
    {
        $mock = $this->getMockBuilder(NumberFormatter::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }
}
