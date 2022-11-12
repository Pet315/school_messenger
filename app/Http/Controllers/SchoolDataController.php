<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 3) {
            return view('school_data.school_data');
        } else {
            return view('error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        if (Auth::user()->role_id == 3) {
            $users = User::get();
            $roles = Role::get();
            return view('school_data.all_accounts', ['users' => $users, 'roles' => $roles]);
        } else {
            return view('error');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role_id == 3) {
            $school_class = $request->school_class;
            return view('school_data.class_accounts', ['school_class' => $school_class]);
        } else {
            return view('error');
        }
    }

    public function choose_class() {
        if (Auth::user()->role_id == 3) {
            $school_classes = SchoolClass::get();
            return view('school_data.choose_class', ['school_classes' => $school_classes]);
        } else {
            return view('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
