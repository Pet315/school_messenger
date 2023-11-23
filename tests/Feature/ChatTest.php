<?php

namespace Tests\Feature;

use Tests\TestCase;

class ChatTest extends TestCase
{
    public function test_create_chat()
    {
        $this->post('/login', [
            'email' => 'm_kolos@gmail.com',
            'password' => '1234',
        ]);
        $response = $this->post(route('chats.store'), [
            'name' => 'abc',
            'school_class_id' => 7
        ]);

        $response->assertStatus(200);
    }

    public function test_edit_chat()
    {
        $this->post('/login', [
            'email' => 'm_kolos@gmail.com',
            'password' => '1234',
        ]);

        $response = $this->put(route('chats.update', 1), [
            'name' => 'abcde',
            'school_class_id' => 7
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_chat()
    {
        $this->post('/login', [
            'email' => 'm_kolos@gmail.com',
            'password' => '1234',
        ]);

        $response = $this->delete(route('chats.destroy', 2), []);

        $response->assertStatus(200);
    }
}
