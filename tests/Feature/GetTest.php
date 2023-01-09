<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTest extends TestCase
{
    public function test_main_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

}
