<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;



class UserController extends Controller
{
    //
    function login(LoginRequest $request) {
        $validator = Validator::make($request->all(), $request->rules());
        if (!$validator->fails()) {
            $userdata = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            if (Auth::attempt($userdata)) { // el attempt mira a la bd (?)
                // Redireccionem a la home principal de l'usuari
                $token = $request->user()->createToken('token');
                return ['token' => $token->plainTextToken];
            }
        }
    }

    function signup(Request $request) {
        $product = User::create($request->all());
        return response()->json($product, 200);
    }

    function delete($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }
}
