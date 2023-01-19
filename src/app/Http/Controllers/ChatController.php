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
use Termwind\Components\Ol;

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
    public function create($message='', $color='')
    {
        if (Auth::user()->role_id == 2) {
            $school_members = SchoolMember::where('user_id', Auth::user()->id)->get();
            foreach ($school_members as $school_member) {
                $school_classes[] = SchoolClass::find($school_member['school_class_id']);
            }
            return view('chats.create_chat', ['school_classes' => $school_classes, 'message' => $message,
                'color' => $color]);
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
    public function store(Request $request, $old_messages=[])
    {
        $chats = Chat::get();
        foreach ($chats as $chat) {
            if ($chat['name'] == $request->name) {
                $message = 'This name already exists. Please, enter another name';
                return $this->create($message, 'red');
            }
        }
        Chat::insert([
            'name' => $request->name
        ]);
        $school_members = SchoolMember::where('school_class_id', $request->school_class_id)->get();
        $chat = Chat::where('name', $request->name)->get()[0];
        foreach ($school_members as $school_member) {
            $users[] = User::find($school_member['user_id']);
        }
        foreach ($users as $user) {
            ChatMember::insert([
                'chat_id' => $chat['id'],
                'user_id' => $user['id']
            ]);
        }
        foreach ($old_messages as $old_message) {
            OldMessage::insert([
                'value' => $old_message['value'],
                'user_id' => $old_message['user_id'],
                'chat_id' => $chat['id'],
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
    public function edit($id, $message='', $color='')
    {
        $chat = Chat::find($id);
        $school_classes = SchoolClass::get();
        return view('chats.edit_chat', ['chat' => $chat, 'school_classes' => $school_classes,
            'message' => $message, 'color' => $color]);
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
        $chats = Chat::get();
        foreach ($chats as $chat) {
            if ($chat['name'] == $request->name) {
                $message = 'This name already exists. Please, enter another name';
                return $this->edit($id, $message, 'red');
            }
        }
        $chat_members = ChatMember::where('chat_id', $id)->get();
        foreach ($chat_members as $chat_member) {
            $user = User::find($chat_member['user_id']);
            if ($user['role_id'] == 1) {
                $school_member = SchoolMember::where('user_id', $user['id'])->get()[0];
                if ($school_member['school_class_id'] != $request->school_class_id) {
                    $message = 'This school class is not for this chat';
                    return $this->edit($id, $message, 'red');
                }
            }
        }
        $old_messages = OldMessage::where('chat_id', $id)->get();
        $this->destroy($id);
        return $this->store($request, $old_messages);
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
