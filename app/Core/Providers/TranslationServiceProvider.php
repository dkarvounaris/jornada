<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // See https://laravel.com/docs/10.x/localization#object-replacement-formatting
/*        Lang::stringable(function (Money $money) {
            return $money->formatTo('en_GB');
        });*/
        // $this->loadTranslationsFrom(__DIR__.'/../lang', 'courier');
    }
}
