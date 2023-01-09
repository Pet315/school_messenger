<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class AccountTest extends TestCase
{
//    use RefreshDatabase;

    public function test_create_account()
    {
        $response = $this->post(route('accounts.store'), [
            'email' => 'abc@gmail.com',
            'password' => '999',
            'name_surname' => 'abc',
            'patronymic' => 'abc',
            'phone_number' => '',
            'other_info' => 'abc',
            'role_id' => 1
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_edit_account()
    {
        $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response = $this->put(route('accounts.update', 1), [
            'email' => 'abcd@gmail.com',
            'password' => '9991',
            'name_surname' => 'abcd',
            'patronymic' => 'abcd',
            'phone_number' => '',
            'other_info' => 'abcd',
            'role_id' => 1
        ]);
        $response->assertStatus(200);
    }

    public function test_delete_account()
    {
        $this->post('/login', [
            'email' => 'romvas44@gmail.com',
            'password' => '123',
        ]);

        $response = $this->delete(route('accounts.destroy', 2), []);

        $response->assertStatus(200);
    }

}
