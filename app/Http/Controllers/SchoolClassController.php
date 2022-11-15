<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 3) {
            $school_classes = SchoolClass::get();
            return view('school_classes.choose_class', ['school_classes' => $school_classes]);
        } else {
            return view('error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 3) {
            $message = '';
            return view('school_classes.create_class', ['message' => $message]);
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
        $school_classes = SchoolClass::get();
        foreach ($school_classes as $school_class) {
            if ($school_class['name'] == $request->name) {
                $message = 'This name already exists. Please, enter another name';
                return view('school_classes.create_class', ['message' => $message, 'color' => 'red']);
            }
        }
        SchoolClass::insert([
            'name' => $request->name
        ]);
        $message = 'New class '.$request->name.' has been created!';
        return view('school_classes.create_class', ['message' => $message, 'color' => 'darkgreen']);
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
        $school_class = SchoolClass::find($id);
        return view('school_classes.edit_class', ['school_class' => $school_class]);
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
        $school_members = SchoolMember::where('school_class_id', $id)->get();
        $this->destroy($id);
        SchoolClass::insert([
            'name' => $request->name
        ]);
        $id = SchoolClass::where('name', $request->name)->get()[0]['id'];
        foreach ($school_members as $school_member) {
            SchoolMember::insert([
                'user_id' => $school_member['user_id'],
                'school_class_id' => $id
            ]);
        }
        $request = new Request();
        $request->school_class_id = $id;
        return SchoolDataController::store($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolMember::where('school_class_id', $id)->delete();
        SchoolClass::destroy($id);
        return view('school_data.school_data');
    }
}
