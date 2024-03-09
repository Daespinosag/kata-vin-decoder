<?php

namespace Domains\Users\Actions;

use App\Models\User;
use Services\Telesing\TelesignService;

final readonly class ValidatePhoneCodeAction
{
    public function __construct(
        protected TelesignService $telesignService
    ){
    }

    public function run(array $parameters): array
    {
        $token = null;
        $user = User::where('phone', $parameters['phone'])->where('phone_code', $parameters['phone_code'])->firstOrFail();

        $response = $this->telesignService->validateVerificationCode($user->code_verification, $parameters['code_verification']);

        if ($response['verify']['code_state'] == "VALID"){
            $user->phone_verified_at = now();
            $user->save();

            $token = $user->createToken('NombreDelToken')->plainTextToken;
        }

        return [ 'user' => $user->fresh(), 'token' => $token];
    }
}
