<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StorePostRequest;
use App\Models\ChatMember;
use App\Models\OldMessage;
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
        $user = User::find($id);
        $roles = Role::get();
        return view('accounts.edit_profile', ['user' => $user, 'roles' => $roles]);
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
        if (Auth::user()->role_id == 3) {
            $this->destroy($id);
            return $this->store($request);
        }
        $user = User::find($id);
        $school_members = SchoolMember::where('user_id', $id)->get();
        $chat_members = ChatMember::where('user_id', $id)->get();
        $old_messages = OldMessage::where('user_id', $id)->get();
        $this->destroy($id);
        User::insert([
            'email' => $user['email'],
            'password' => $user['password'],
            'name_surname' => $user['name_surname'],
            'patronymic' => $user['patronymic'],
            'phone_number' => $user['phone_number'],
            'other_info' => $request->other_info,
            'role_id' => $user['role_id']
        ]);
        $id = User::where('email', $user['email'])->get()[0]['id'];
        foreach ($school_members as $school_member) {
            SchoolMember::insert([
                'user_id' => $id,
                'school_class_id' => $school_member['school_class_id']
            ]);
        }
        foreach ($chat_members as $chat_member) {
            ChatMember::insert([
                'chat_id' => $chat_member['chat_id'],
                'user_id' => $id
            ]);
        }
        foreach ($old_messages as $old_message) {
            OldMessage::insert([
                'value' => $old_message['value'],
                'user_id' => $id,
                'chat_id' => $old_message['chat_id'],
            ]);
        }
        return redirect(RouteServiceProvider::HOME);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolMember::where('user_id', $id)->delete();
        ChatMember::where('user_id', $id)->delete();
        OldMessage::where('user_id', $id)->delete();
        User::destroy($id);
        return SchoolDataController::create();
    }
}
