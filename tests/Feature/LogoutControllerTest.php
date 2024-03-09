<?php

namespace Tests\Feature;

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LogoutControllerTest extends TestCase
{
    public function testUserCanLogoutSuccessfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/auth/logout');

        $response->assertOk()
            ->assertJson([
                'message' => 'Has salido de la cuenta',
            ]);

        // Asegurarse de que los tokens del usuario han sido eliminados
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);
    }
}
