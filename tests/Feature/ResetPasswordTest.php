<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test example.
     */
    public function testRequestNewPasswordT(): void
    {
        $this->artisan("ip:allow 127.0.0.1")->assertExitCode(0);
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'Password123456',
        ];
        User::factory()->create($userData);
        $response = $this->get(route('auth.reset-password'));
        $response->assertStatus(200);
        $response = $this->post(route('auth.request-reset'), ['email' => $userData['email']]);
        $response->assertRedirect(route('auth.confirmation'));
        $user = User::where('email', $userData['email'])->first();
        $response = $this->get(route('auth.reset-password', ['reset_token' => $user->reset_token]));
        $response->assertStatus(200);
        $response = $this->patch(route('auth.reset-password.update', ['user' => $user]), ['password' => 'Password1234567', 'password_confirmation' => 'Password1234567']);
        $response->assertRedirect(route('auth.login'));

    }}

