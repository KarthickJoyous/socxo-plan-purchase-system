<?php

namespace App\Http\Controllers\User\Auth;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\User\Auth\UserLoginRequest;

class LoginController extends Controller
{
    /** 
     * To register an user to application.
     * @param UserLoginRequest $request
     * @return RedirectResponse  
    */
    public function __invoke(UserLoginRequest $request) {

        try {

            $user = User::firstWhere(['email' => $request->email]);

            $login = Hash::check($request->password, $user->password);

            throw_if(!$login, new Exception(__('messages.user.login.invalid_credentials')));

            Auth::login($user);

            return redirect()->route('user.home')->with('success', __('messages.user.login.login_success'));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
