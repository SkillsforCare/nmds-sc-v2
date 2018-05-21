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

            if(empty($value))
                return true;

            $minAge = 14;
            $maxAge = 100;

            $diff = now()->diff(new Carbon($value))->y;

            return $diff >= $minAge && $diff <= $maxAge;
        }, 'The age must be between 14 and 100');

        Validator::extend('ni_number', function ($attribute, $value, $parameters, $validator) {

            if(empty($value))
                return true;

            if(strlen($value) !== 9)
                return false;

            return preg_match_all("/[ABCEGHJKLMNOPRSTWXYZabceghjklmnoprstwxyz][ABCEGHJKLMNPRSTWXYZabceghjklmnprstwxyz][0-9]{6}[A-D\sa-d]{0,1}/", $value );

            return preg_match('^[ABCEGHJKLMNOPRSTWXYZabceghjklmnoprstwxyz][ABCEGHJKLMNPRSTWXYZabceghjklmnprstwxyz][0-9]{6}[A-D\sa-d]{0,1}$', $value);
        }, 'Invalid National Insurance Number. It must be 9 characters in the format AB123456C');
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
