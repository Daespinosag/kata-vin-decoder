<?php

namespace Tests\Unit\src\Domains\Users;

use Tests\TestCase;
use App\Models\User;
use Domains\Users\Actions\LoginAction;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class LoginActionTest extends TestCase
{
    /** @test */
    public function it_successfully_logs_in_a_user()
    {
        // Crear un usuario de prueba
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'phone_code' => '+1',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(), // Asumiendo que esto es cómo validas el teléfono
        ]);

        $action = new LoginAction();

        $result = $action->run('test@example.com', 'password');

        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);
        $this->assertEquals($user->email, $result['user']->email);
    }

    /** @test */
    public function it_fails_login_with_incorrect_credentials()
    {
        $this->expectException(AuthenticationException::class);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'phone_code' => '+1',
            'password' => Hash::make('correct-password'),
            'phone_verified_at' => now(),
        ]);

        $action = new LoginAction();

        $action->run('test@example.com', 'wrong-password');
    }

    /** @test */
    public function it_fails_login_with_unvalidated_phone()
    {
        $this->expectException(AuthenticationException::class);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'phone_code' => '+1',
            'password' => Hash::make('password'),
        ]);

        $action = new LoginAction();

        $action->run('test@example.com', 'password');
    }
}
