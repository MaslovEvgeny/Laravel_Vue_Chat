<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class,'logout']);
    Route::resource('messages', MessagesController::class);
    Route::get('/get_users', [UsersController::class, 'getContacts']);
    Route::get('/send_mail', [MailController::class, 'index']);
});

Route::post('login', [AuthController::class,'login']);

