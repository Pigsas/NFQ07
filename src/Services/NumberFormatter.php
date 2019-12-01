<?php


namespace App\Services;

class NumberFormatter
{
    protected $number;

    public function __construct(float $number)
    {
        $this->number = $number;
    }

    public function formatNumber(): string
    {


        $number = round($this->number, 2);

        if ($this->number < 0) {
            $number = -$number;
        }
        if ($number >= 0 && $number < 1000) {
            if (((number_format($number, 2) * 100) % 100) == 0) {
                $formatedNumber =  $number;
            } else {
                $formatedNumber = number_format($number, 2);
            }
        } elseif ($number >= 1000 && $number < 99950) {
            $formatedNumber = number_format($number, 0, '.', ' ');
        } elseif ($number >= 99950 && $this->number < 999500) {
            $number = round($number/1000, 0);

            $formatedNumber = $number.'K';
        } elseif ($number >= 999500) {
            $number = round($number/1000000, 2);

            $formatedNumber = number_format($number, 2).'M';
        }

        if ($this->number < 0) {
            return '-'.$formatedNumber;
        } else {
            return $formatedNumber;
        }
    }
}
