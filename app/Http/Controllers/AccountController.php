<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StorePostRequest;
use App\Models\SchoolClass;
use App\Models\SchoolMember;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        $user = Auth::user();
        return view('accounts.profile', ['role' => $role, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 3) {
            $roles = Role::get();
            return view('accounts.create_account', ['roles' => $roles]);
        }
        return view('error');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::insert([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name_surname' => $request->name_surname,
            'patronymic' => $request->patronymic,
            'phone_number' => $request->phone_number,
            'other_info' => $request->other_info,
            'role_id' => $request->role_id
        ]);
//        $user = User::where('email', $request->email)->where('role_id', $request->role_id)->get()[0];

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($user_id)
    {
        $user = User::find($user_id);
        $role = Role::find($user['role_id']);
        return view('accounts.profile', ['role' => $role, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 3) {
            SchoolMember::where('user_id', $id)->delete();
            User::destroy($id);
            return SchoolDataController::create();
        } else {
            return view('error');
        }
    }
}
