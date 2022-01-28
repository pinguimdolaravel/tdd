<?php

use App\Http\Controllers\RegisterController;
use App\Mail\Invitation;
use App\Models\Invites;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('register', RegisterController::class)->name('register');

Route::post('invite', function () {
    Mail::to(request()->email)->send(new Invitation());
    Invites::create(['email' => request()->email]);
});
