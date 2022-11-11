<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SchoolDataController;

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

//Route::get('/profile', function () {
//    $role = Role::find(Auth::user()->role_id);
//    $user = Auth::user();
//    return view('profile', ['role' => $role, 'user' => $user]);
//})->middleware(['auth', 'verified'])->name('profile');

//Route::get('/school_data', function () {
//    return view('accounts.school_data');
//});
//
//Route::get('/creating_accounts', function () {
//    return view('accounts.creating_accounts');
//});

require __DIR__.'/auth.php';
