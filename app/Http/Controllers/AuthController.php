<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if ($token = auth('api')->attempt($credentials)) {
            return $this->resJson(['token' => $token], true, 200);
        } else {
            return $this->resJson("Invalid credentials", false, 401);
        }
    }
}
