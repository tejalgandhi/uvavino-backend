<?php

namespace App\Http\Controllers\Auth;

use Backpack\CRUD\app\Http\Controllers\Auth\ForgotPasswordController as OriginalForgotPasswordController;

class ForgotPasswordController extends OriginalForgotPasswordController
{
    protected $redirectTo = '/admin/dashboard';
}
