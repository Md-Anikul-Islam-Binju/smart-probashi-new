<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
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
        Validator::extend('is_adult', function ($attribute, $value, $parameters, $validator) {
            $inputDate = \Carbon\Carbon::parse($value);
            $eighteenYearsAgo = now()->subYears(18);
            return $inputDate->lte($eighteenYearsAgo);
        });

        Validator::replacer('is_adult', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be at least 18 years old.');
        });


        Validator::extend('date_before', function ($attribute, $value, $parameters, $validator) {
            $dateBefore = $validator->getData()[$parameters[0]];
            return strtotime($value) > strtotime($dateBefore);
        });

        Validator::replacer('date_before', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':date', $parameters[0], 'The expiration date must be greater than the issue date.');
        });
    }
}
