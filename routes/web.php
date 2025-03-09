<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response(['message' => 'OK']));
