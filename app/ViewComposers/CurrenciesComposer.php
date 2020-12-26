<?php


namespace App\ViewComposers;


use App\Services\CurrencyConvertion;
use Illuminate\View\View;

class CurrenciesComposer
{
    public function compose(View $view)
    {

         $currencies = CurrencyConvertion::getCurrencies();

         $view->with('currencies', $currencies);
    }
}
