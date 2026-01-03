<?php

use App\Http\Controllers\chirpcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', [chirpcontroller::class, 'index']);
