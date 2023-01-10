<?php

namespace App\Http\Controllers\Auth;

use Backpack\CRUD\app\Http\Controllers\Auth\LoginController as OriginalLoginController;

class LoginController extends OriginalLoginController
{
    protected $redirectTo = '/admin/dashboard';
}
