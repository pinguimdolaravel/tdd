<?php

use App\Http\Controllers\RegisterController;
use App\Mail\Invitation;
use App\Models\Invites;
use App\Models\Todo;
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

Route::get('todo', function () {
    return view('todo', ['todos' => Todo::all()]);
})->name('todo.index');

Route::post('todo', function () {
    Todo::query()
        ->create([
            'title'          => request()->title,
            'description'    => request()->description,
            'assigned_to_id' => request()->assigned_to,
        ]);

    return redirect()->route('todo.index');
})->name('todo.store');
