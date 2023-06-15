<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorPatient;

class LoginController extends Controller
{
    public function show(){
        if(Auth::guard('web')->check()){
            return redirect('home');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();
        
        if (Auth::guard('web')->validate($credentials)) {
            $user = Auth::guard('web')->getLastAttempted();
            Auth::guard('web')->login($user, $request->has('remember'));
    }
    return redirect()->back()->withInput($request->only('username'))->withErrors([
        'login_error' => 'Estas credenciales no coinciden con nuestros registros.'
    ]);
}
}