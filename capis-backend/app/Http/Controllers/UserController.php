<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        
        Validator::validate($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',

        ]);

        $user = User::where('username', $request->username)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $response = [
                    'user' => $user
                ];
                return response($response, 200);
            } else {
                $response = ['message' => 'Contraseña incorrecta'];
                return response($response, 422);
            }

        } else {
            $response = ['message' => 'Usuario no encontrado'];
            return response($response, 422);
        }
    }

    public function registrarUsuario(Request $request) {
        Validator::validate($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->HashedUsr = Hash::make($request->username);
        $user->save();
        
        $response = [
            'user' => $user,
        ];

        return response($response, 200);
    }
}