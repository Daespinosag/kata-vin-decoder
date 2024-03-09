<?php

namespace Tests\Unit\src\Domains\Users;

use Domains\Users\Actions\RegisterUserAction;
use Domains\Users\Events\UserRegistered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Services\Telesing\TelesignContract;
use Tests\TestCase;

class RegisterUserActionTest extends TestCase
{

    /** @test */
    public function it_registers_a_user_and_dispatches_an_event()
    {
        // Preparar: Fake el evento UserRegistered
        Event::fake();

        // Crear una instancia de la acción
        $action = new RegisterUserAction();

        // Datos de usuario de prueba
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'phone' => '1234567890',
            'phone_code' => '+1',
        ];

        // Ejecutar: Llamar al método run de RegisterUserAction
        $user = $action->run($userData);

        // Afirmar: Verificar que el usuario se ha creado en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        // Afirmar: Verificar que la contraseña se ha hasheado correctamente
        $this->assertTrue(Hash::check('password', $user->password));

        // Afirmar: Verificar que el evento UserRegistered ha sido disparado
        Event::assertDispatched(UserRegistered::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }

}
