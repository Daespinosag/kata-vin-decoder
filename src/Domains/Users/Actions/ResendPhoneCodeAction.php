<?php

namespace Domains\Users\Actions;

use App\Models\User;
use Domains\Users\Events\SendVerificationCode;

final readonly class ResendPhoneCodeAction
{
    public function run(array $parameters): User
    {
        $user = User::where('phone', $parameters['phone'])->where('phone_code', $parameters['phone_code'])->firstOrFail();

        SendVerificationCode::dispatch($user, mt_rand(1000, 9999));

        return $user->fresh();
    }
}
