<?php

namespace Domains\Users\Actions;

use App\Models\User;
use Domains\Users\Events\UserRegistered;
use Illuminate\Support\Facades\Hash;

final readonly class RegisterUserAction
{
    public function run(array $creating): User
    {
        $user = User::create([
                'name'          => $creating['name'],
                'email'         => $creating['email'],
                'password'      => Hash::make($creating['password']),
                'phone'         => $creating['phone'],
                'phone_code'    => $creating['phone_code'],
            ]);

        UserRegistered::dispatch($user, mt_rand(1000, 9999));

        return $user;
    }
}
