<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SchoolDataController;
use App\Http\Controllers\SchoolMemberController;
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

Route::resource('school_members', SchoolMemberController::class);

Route::resource('school_classes', SchoolClassController::class);

//Route::get('/profile', function () {
//    $role = Role::find(Auth::user()->role_id);
//    $user = Auth::user();
//    return view('profile', ['role' => $role, 'user' => $user]);
//})->middleware(['auth', 'verified'])->name('profile');

//Route::get('/create_account', function () {
//    if (Auth::user()->role_id == 3) {
//        $roles = Role::get();
//        return view('accounts.create_account', ['roles' => $roles]);
//    }
//    return view('error');
//});

require __DIR__.'/auth.php';
