<?php

/**
 * Contains custom things that we want to do with our
 * Application.
 */

namespace App\Cart;

use Money\Currency;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as BaseMoney; // from moneyphp/money package

class Money
{
    protected $price;

    public function __construct($value)
    {
        $this->price =  new BaseMoney($value, new Currency('GBP'));
    }
    public function amount()
    {
        return $this->price->getAmount();
    }

    public function formatted()
    {

        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('en_GB', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );
        return $formatter->format($this->price);
    }
}
