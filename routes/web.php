<?php

use App\Livewire\About;
use App\Livewire\Contacts;
use App\Livewire\Counter;
use App\Livewire\Home;
use App\Livewire\Update;
use App\Livewire\Users;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/counter', Counter::class);
Route::get('/', Home::class);
Route::get('/about', About::class);
Route::get('/contacts', Contacts::class);
Route::get('/users', Users::class);
Route::get('/users/{id}', Update::class);