<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

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

            try {
                $date = Carbon::parse($value);
            } catch(\Exception $e) {
                return false;
            }

            $minAge = 14;
            $maxAge = 100;

            $diff = now()->diff($date)->y;

            return $diff >= $minAge && $diff <= $maxAge;
        });

        Validator::extend('ni_number', function ($attribute, $value, $parameters, $validator) {

            if(empty($value))
                return true;

            if(strlen($value) !== 9)
                return false;

            return preg_match_all("/[ABCEGHJKLMNOPRSTWXYZabceghjklmnoprstwxyz][ABCEGHJKLMNPRSTWXYZabceghjklmnprstwxyz][0-9]{6}[A-D\sa-d]{0,1}/", $value );

            return preg_match('^[ABCEGHJKLMNOPRSTWXYZabceghjklmnoprstwxyz][ABCEGHJKLMNPRSTWXYZabceghjklmnprstwxyz][0-9]{6}[A-D\sa-d]{0,1}$', $value);
        }, 'Invalid National Insurance Number. It must be 9 characters in the format AB123456C');

        Collection::macro('requiresAttention', function () {
            return $this->where('attention_required', '!=', '');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment(['local', 'testing'])) {
            $this->app->register(DuskServiceProvider::class);
        }

        if ($this->app->environment(['alpha', 'uat'])) {
            $this->app->register(\Rollbar\Laravel\RollbarServiceProvider::class);
        }
    }
}
