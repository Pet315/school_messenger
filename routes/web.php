<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SchoolDataController;
use App\Http\Controllers\SchoolMemberController;
use App\Http\Controllers\ChatMemberController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('accounts', AccountController::class);

Route::get('/accounts', [AccountController::class, 'index'])->middleware(['auth', 'verified'])->name('accounts');

Route::resource('school_data', SchoolDataController::class);

Route::resource('school_members', SchoolMemberController::class);

Route::resource('chat_members', ChatMemberController::class);

//Route::get('/chat_members/link_to_profile/{user_id}', [ChatMemberController::class, 'link_to_profile']);

Route::resource('chats', ChatController::class);

require __DIR__.'/auth.php';
