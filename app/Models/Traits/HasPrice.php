<?php

namespace App\Models\Traits;

use Money\Money;
use Money\Currency;
use NumberFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\Currencies\ISOCurrencies;

trait HasPrice
{
    public function getPriceAttribute($value)
    {
        return new Money($value, new Currency('GBP'));
    }

    public function getFormattedPriceAttribute()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_GB', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );
        return $formatter->format($this->price);
    }
}
