<?php

namespace App\Http\Controllers\Auth;

use Backpack\CRUD\app\Http\Controllers\Auth\RegisterController as OriginalRegisterController;

class RegisterController extends OriginalRegisterController
{
    protected $redirectTo = '/admin/dashboard';
}
