<?php

namespace Domains\Users\Actions;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

final readonly class LoginAction
{
    /**
     * @throws AuthenticationException
     */
    public function run(string $email, string $password): array
    {
        $user = User::where('email', $email)->firstOrFail();

        if (! $this->isPasswordValid($user, $password)) {
            throw new AuthenticationException('Las credenciales proporcionadas no coinciden con nuestros registros.');
        }

        if (! $this->isPhoneUserValidated($user)) {
            throw new AuthenticationException('El teléfono del usuario no ha sido validado.');
        }

        $token = $user->createToken('NombreDelToken')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token
        ];
    }

    private function isPhoneUserValidated(User $user): bool
    {
        return null != $user->phone_verified_at;
    }

    private function isPasswordValid(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }
}
