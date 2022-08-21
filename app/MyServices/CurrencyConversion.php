<?php
namespace App\MyServices;

use App\Models\Currency;

class CurrencyConversion{
    protected static $currenciesContainer;

    protected static function loadContainer()
    {
        if (is_null(self::$currenciesContainer)) {
            $currencies = Currency::get();
            foreach ($currencies as $cur) {
                self::$currenciesContainer[$cur->code] = $cur;
            }
        }
    }
    
    public static function getCurrencies()
    {
        self::loadContainer();
        return self::$currenciesContainer;
    }
    
    public static function getCurCode()
    {
        return session('currency', 'BYN');
    }
    
    public static function convert($sum, $from = 'BYN', $to = NULL)
    {
        self::loadContainer();
        $originCurrency = self::$currenciesContainer[$from];
        if (is_null($to)) {
            $to = self::getCurCode();
        }
        $targetCurrency = self::$currenciesContainer[$to];

        return round($sum * $originCurrency->rate / $targetCurrency->rate, 2);
    }
}