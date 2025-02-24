<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;

test('Login with a user with valid credentials.', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password_123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password_123',
    ]);

    $response->assertStatus(200);

    $response->assertJson(fn (AssertableJson $json) => $json->has('data.token'));
});

test('Fails to log in with invalid credentials.', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrong_password',
    ]);

    $response->assertStatus(401);
});

test('Fails to login with a non existent user.', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(401);
});
