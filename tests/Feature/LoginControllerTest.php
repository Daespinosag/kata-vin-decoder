<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginControllerTest extends TestCase
{
    public function testUserCanLoginWithCorrectCredentials()
    {
        // Preparación: Crear un usuario de prueba
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'phone_code' => '+1',
            'password' => Hash::make('password'),
            'phone_verified_at' => now(),
        ]);

        // Ejecutar: Enviar una solicitud POST al endpoint de login
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Afirmar: La respuesta debe ser exitosa y contener el mensaje esperado y el token
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'El usuario se ha creado exitosamente.',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ])
            ->assertJsonStructure([
                'token'
            ]);
    }
}

