<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Domains\Users\Actions\LoginAction;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest, LoginAction $loginAction): \Illuminate\Http\JsonResponse
    {
        $response = $loginAction->run($loginRequest->email, $loginRequest->password);

        return response()->json([
            'message'   => 'El usuario se ha creado exitosamente.',
            'user'      => $response['user']->toArray(),
            'token'     => $response['token']
        ], 200);
    }
}
