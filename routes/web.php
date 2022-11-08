<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

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

Route::get('/dashboard', function () {
    $role = Role::find(Auth::user()->role_id);
    $user = Auth::user();
    return view('dashboard', ['role' => $role, 'user' => $user]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
