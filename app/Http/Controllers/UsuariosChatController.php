<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAsociates;
use Illuminate\Http\Request;

class UsuariosChatController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userAsociates = UserAsociates::all();

        return response()->json([
            'users' => $users,
            'userAsociates' => $userAsociates,
        ]);
    }
}