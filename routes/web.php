<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SchoolDataController;
use App\Http\Controllers\SchoolMemberController;
use App\Http\Controllers\ChatMemberController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SchoolClassController;

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

Route::get('/school_data/remove_from_class/{role_id}/{user_id}', [SchoolDataController::class, 'remove_from_class']);

Route::resource('school_members', SchoolMemberController::class);

Route::resource('chat_members', ChatMemberController::class);

Route::resource('chats', ChatController::class);

Route::resource('school_classes', SchoolClassController::class);

require __DIR__.'/auth.php';
