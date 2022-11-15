<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\OldMessage;
use App\Models\SchoolClass;
use App\Models\SchoolMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
    public function create()
    {
        if (Auth::user()->role_id == 2) {
            $school_members = SchoolMember::where('user_id', Auth::user()->id)->get();
            foreach ($school_members as $school_member) {
                $school_classes[] = SchoolClass::find($school_member['school_class_id']);
            }
            return view('chats.create_chat', ['school_classes' => $school_classes]);
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
        Chat::insert([
            'name' => $request->name
        ]);
        $chat = Chat::where('name', $request->name)->get()[0];
        $school_members = SchoolMember::where('school_class_id', $request->school_class_id)->get();
        foreach ($school_members as $school_member) {
            $users[] = User::find($school_member['user_id']);
        }
        foreach ($users as $user) {
            ChatMember::insert([
                'chat_id' => $chat['id'],
                'user_id' => $user['id']
            ]);
        }
        return ChatMemberController::create();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $old_messages = OldMessage::where('chat_id', '=', $id)->get();
        $i=100;
        if (count($old_messages) > $i) {
            $j = 0;
            while ($j < $i-10) {
                OldMessage::where('id', '=', $old_messages[$j]['id'])->delete();
                $j++;
            }
        }
        $chat_name = Chat::find($id)['name'];
        $users = User::get();
        return view('chats.chat', ['chat_id' => $id, 'chat_name' => $chat_name,
            'old_messages' => $old_messages, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chat = Chat::find($id);
        $school_classes = SchoolClass::get();
        return view('chats.edit_chat', ['chat' => $chat, 'school_classes' => $school_classes]);
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
        $this->destroy($id);
        return $this->store($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 2) {
            ChatMember::where('chat_id', $id)->delete();
            OldMessage::where('chat_id', $id)->delete();
            Chat::destroy($id);
            return ChatMemberController::create();
        } else {
            return view('error');
        }
    }
}
