<?php

namespace App\Http\Controllers\User\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\User\Auth\UserRegisterRequest;

class RegisterController extends Controller
{   
    /** 
     * To register an user to application.
     * @param UserRegisterRequest $request
     * @return RedirectResponse  
    */
    public function __invoke(UserRegisterRequest $request): RedirectResponse {

        try {

            $validated = $request->validated();

            $user = DB::transaction(function() use($validated){
                
                $user = User::Create($validated);

                throw_if(!$user, new Exception(__('messages.user.register.register_failed')));

                return $user;
            });

            auth('web')->login($user);

            return redirect()->route('user.dashboard')->with('success', __('messages.user.register.register_success'));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
