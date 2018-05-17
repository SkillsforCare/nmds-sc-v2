<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Validator::extend('age_between', function ($attribute, $value, $parameters, $validator) {
            $minAge = 14;
            $maxAge = 100;

            $diff = now()->diff(new Carbon($value))->y;

            return $diff >= $minAge && $diff <= $maxAge;
        }, 'The age must be between 14 and 100');
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
