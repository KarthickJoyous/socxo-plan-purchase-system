<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    /**
     * To show the profile details.
    */
    public function __invoke()
    {
        return view('users.profile', [
            'user' => auth('web')->user()
        ]);
    }
}
