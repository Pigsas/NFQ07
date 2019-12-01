<?php

namespace App\Services\Tests;

use App\Services\MoneyFormatter;
use App\Services\NumberFormatter;
use PHPUnit\Framework\TestCase;

class MoneyFormatterTest extends TestCase
{
    private $mock;
    private $tuc;

    protected function setUp()
    {
        $this->mock = $this->getNumberFormatterMock();
        $this->tuc = new MoneyFormatter($this->mock);
    }

    /**
     * @dataProvider provideNumbersForEuroFormat
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber,
     * @param string $willReturn
     */
    public function testIfReturnEuroFormat($expectedFormattedNumber, $actualNumber, $willReturn)
    {
        $this->mock->method('formatNumber')
            ->with($actualNumber)
            ->willReturn($willReturn);

        $number = $this->tuc->formatEur($actualNumber);

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersForEuroFormat(): array
    {
        return [
            ['2.84M €', 2835779, '2.84M'],
            ['211.99 €', 211.99, '211.99']
        ];
    }
    /**
     * @dataProvider provideNumbersForUsdFormat
     * @param string $expectedFormattedNumber,
     * @param float $actualNumber
     * @param string $willReturn
     */
    public function testIfReturnUsdFormat($expectedFormattedNumber, $actualNumber, $willReturn)
    {
        $this->mock->method('formatNumber')
            ->with($actualNumber)
            ->willReturn($willReturn);

        $number = $this->tuc->formatUsd($actualNumber);

        $this->assertSame($expectedFormattedNumber, $number);
    }
    public function provideNumbersForUsdFormat(): array
    {
        return [
            ['$2.84M', 2835779, '2.84M'],
            ['$211.99', 211.99, '211.99'],
        ];
    }
    private function getNumberFormatterMock()
    {
        $mock = $this->getMockBuilder(NumberFormatter::class)
            ->getMock();

        return $mock;
    }
}
