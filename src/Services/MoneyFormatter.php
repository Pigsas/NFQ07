<?php


namespace App\Services;

class MoneyFormatter
{
    /**
     * @var NumberFormatter
     */
    private $formatter;

    public function __construct(NumberFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function formatEur($number): string
    {
        return $this->formatter->formatNumber($number).' €';
    }

    public function formatUsd($number): string
    {
        return '$'.$this->formatter->formatNumber($number);
    }
}
