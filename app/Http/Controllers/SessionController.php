<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function getUserId()
    {
        if (Auth::guard('web_asociates')->check()) {
            return response()->json([
                'userId' => Auth::guard('web_asociates')->user()->id,
            ]);
        }

        return response()->json([
            'error' => 'No user is currently logged in',
        ], 401);
    }
    public function getDoctorId() {
    return response()->json([
        'doctorId' => session('doctorId'),
    ]);
}

}
