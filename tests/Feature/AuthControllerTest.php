<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
//  These tests were written with help from Copilot.
    use RefreshDatabase, WithoutMiddleware;

    public function testIndex()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testRegister()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function testLogout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function testStore()
    {
        $this->artisan("ip:allow 127.0.0.1")->assertExitCode(0);
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'Password123456',
            'password_confirmation' => 'Password123456',
        ];



        $response = $this->put(route('register.store'), $userData);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
        ]);

        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertTrue(Hash::check('Password123456', $user->password));
        $this->assertAuthenticatedAs($user);
    }

    public function testAuthenticate()
    {
        $this->artisan("ip:allow 127.0.0.1")->assertExitCode(0);
        $user = User::factory()->create([
            'password' => Hash::make('Password123456'),
        ]);
        $response = $this->post(route('login.authenticate'), [
            'email' => $user->email,
            'password' => 'Password123456',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }


}
