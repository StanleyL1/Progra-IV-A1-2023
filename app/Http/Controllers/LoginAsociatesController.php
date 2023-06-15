<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAsociatesRequest;
use Illuminate\Support\Facades\Auth;

class LoginAsociatesController extends Controller
{
    public function show(){
        // Aquí debes usar el nuevo guard que definimos en auth.php
        if(Auth::guard('web_asociates')->check()){
            return redirect('home');
        }
        return view('auth.loginAsociados');
    }

    public function login(LoginAsociatesRequest $request){
        $credentials = $request->getCredentials();
        
        // If the authentication is successful, then redirect the user.
        // Also use the new guard here
        if (Auth::guard('web_asociates')->validate($credentials)) {
            $user = Auth::guard('web_asociates')->getLastAttempted();
            Auth::guard('web_asociates')->login($user, $request->has('remember'));
    
            // Save the user ID to the session    
            return redirect()->intended('users');
        }
        
        // If the authentication fails, then redirect the user back to the login form with the actual error.
        return redirect()->back()->withInput($request->only('username'))->withErrors([
            'login_error' => 'Estas credenciales no coinciden con nuestros registros.'
        ]);
    }
    
    
    

}
