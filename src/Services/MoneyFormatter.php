<?php


namespace App\Services;

class MoneyFormatter extends NumberFormatter
{

    public function formatEur(): string
    {
        return $this->formatNumber().' €';
    }

    public function formatUsd(): string
    {
        return '$'.$this->formatNumber();
    }
}
