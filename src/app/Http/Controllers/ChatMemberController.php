<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\OldMessage;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {
        $chat_members = ChatMember::where('user_id', Auth::user()->id)->get();
        if (count($chat_members) > 0) {
            foreach ($chat_members as $chat_member) {
                $chats[] = Chat::find($chat_member['chat_id']);
            }
        } else {
            $chats = 'empty';
        }
        return view('chat_members.chats', ['chats' => $chats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($chat_id)
    {
        $chat_members = ChatMember::where('chat_id', $chat_id)->get();
        $school_class_name = '';
        $one_time = true;
        foreach ($chat_members as $chat_member) {
            $user = User::find($chat_member['user_id']);
            if($user['role_id'] == 1 and $one_time) {
                $school_member = SchoolMember::where('user_id', $user['id'])->get()[0];
                $school_class_name = SchoolClass::find($school_member['school_class_id'])['name'];
                $one_time = false;
            }
            $users[] = $user;
        }
        $roles = Role::get();
        return view('chat_members.participants_list', ['users' => $users, 'roles' => $roles,
            'school_class_name' => $school_class_name]);
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
