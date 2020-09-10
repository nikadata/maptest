<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  /*  public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testExample()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function testUserCanViewLoginForm()
    {
         $response = $this->get('/login');
         $response->assertSuccessful();
         $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewLoginFormWhenAuth()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
}
