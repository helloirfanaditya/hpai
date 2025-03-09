<?php

use App\Http\Controllers\{
    AuthController,
    UserController
};
use Illuminate\Support\Facades\Route;


// custom middleware for future conditions, to keep things flexible
Route::group(['middleware' => 'UserPermission'], function () {
    // login doesnt need this middleware, let users log in first
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('UserPermission');

    Route::get('users', [UserController::class, 'listUsers']);
    Route::post('users', [UserController::class, 'createUser']);
    Route::get('users/{id}', [UserController::class, 'getDetailUser']);
    Route::delete('users/{id}', [UserController::class, 'deleteUser']);
});
