<?php

namespace App\Http\Controllers\Admin;

use GemaDigital\Framework\app\Http\Controllers\Admin\UserCrudController as DefaultUserCrudController;

class UserCrudController extends DefaultUserCrudController
{
    public function setup()
    {
        parent::setup();
    }

    public function setupListOperation()
    {
        parent::setupListOperation();
    }

    public function setupCreateOperation()
    {
        parent::setupCreateOperation();
    }

    public function setupUpdateOperation()
    {
        parent::setupUpdateOperation();
    }
}
