<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        \Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class => \App\Http\Controllers\Auth\LoginController::class,
        \Backpack\CRUD\app\Http\Controllers\Auth\RegisterController::class => \App\Http\Controllers\Auth\RegisterController::class,
        \Backpack\CRUD\app\Http\Controllers\Auth\ResetPasswordController::class => \App\Http\Controllers\Auth\ResetPasswordController::class,
        \Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController::class => \App\Http\Controllers\Auth\ForgotPasswordController::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
