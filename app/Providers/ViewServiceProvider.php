<?php

namespace App\Providers;

use App\Services\CurrencyConvertion;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
/*use Illuminate\View\View;*/



class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.master', 'categories'], 'App\ViewComposers\CategoriesComposer');
        View::composer(['layouts.master', 'layout.card', 'order'], 'App\ViewComposers\CurrenciesComposer');
        View::composer('layouts.master', 'App\ViewComposers\BestProductsComposer');

        View::composer(['*'], function ( $view){
            $currencySymbol = CurrencyConvertion::getCurrencySymbol();
            $view->with('currencySymbol', $currencySymbol);
        });

    }
}
