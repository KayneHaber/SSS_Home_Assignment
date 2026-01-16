<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JamSessionController;

Route::get('/', function () {
    return redirect()->route('sessions.index');
});

Route::resource('sessions', JamSessionController::class);
