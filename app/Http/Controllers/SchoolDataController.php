<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\SchoolMember;
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
            $school_members = SchoolMember::get();
            $school_classes = SchoolClass::get();
            return view('school_data.all_accounts', ['users' => $users, 'roles' => $roles,
                'school_members' => $school_members, 'school_classes' => $school_classes]);
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
    public static function store(Request $request)
    {
        if (Auth::user()->role_id == 3) {
            $school_members = SchoolMember::where('school_class_id', $request->school_class_id)->get();
            $selected_school_class = SchoolClass::find($request->school_class_id);
            if (count($school_members) > 0) {
                foreach ($school_members as $school_member) {
                    $users[] = User::find($school_member['user_id']);
                }
                $roles = Role::get();
                $school_classes = SchoolClass::get();
                return view('school_data.class_accounts', ['users' => $users, 'roles' => $roles,
                    'school_members' => $school_members, 'school_classes' => $school_classes,
                    'selected_school_class' => $selected_school_class]);
            } else {
                $school_members = 'empty';
                return view('school_data.class_accounts', ['school_members' => $school_members,
                    'selected_school_class' => $selected_school_class]);
            }
        } else {
            return view('error');
        }
    }

    public function remove_from_class($school_class_id, $user_id) {
        SchoolMember::where('school_class_id', $school_class_id)->where('user_id', $user_id)->delete();
        $request = new Request();
        $request->school_class_id = $school_class_id;
        return $this->store($request);
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
