<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolClassTest extends TestCase
{
    public function test_create_school_class()
    {
        $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response = $this->post(route('school_classes.store'), [
            'name' => '12-A',
        ]);

        $response->assertStatus(200);
    }

    public function test_edit_school_class()
    {
        $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response = $this->put(route('school_classes.update', 34), [
            'name' => '12-B',
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_school_class()
    {
        $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response = $this->delete(route('school_classes.destroy', 35), []);

        $response->assertStatus(200);
    }
}
