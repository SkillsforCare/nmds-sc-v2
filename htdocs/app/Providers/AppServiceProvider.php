<?php

namespace App\Providers;

use App\Rules\YesNo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('yes_no', function ($attribute, $value, $parameters, $validator) {
            return app(YesNo::class)->passes($attribute, $value);
        }, 'The :attribute must either be Yes or No');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
