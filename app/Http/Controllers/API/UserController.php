<?php

namespace App\Http\Controllers\API;

use GemaDigital\Framework\app\Http\Controllers\API\APIController as DefaultAPIController;
use Illuminate\Http\Request;

class UserController extends DefaultAPIController
{
    /**
     * Get User.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        return json_response([
            'user' => $request->user(),
        ]);
    }
}
