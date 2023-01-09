<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
//    use RefreshDatabase;

    public function test_user_from_db()
    {
        $response = $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_not_from_db()
    {
        $response = $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
    }

}
