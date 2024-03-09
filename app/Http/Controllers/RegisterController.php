<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Domains\Users\Actions\RegisterUserAction;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(
        RegisterRequest $request,
        RegisterUserAction $registerUserAction
    ): JsonResponse{
        $user = $registerUserAction->run($request->all());

        return response()->json([
            'message'   => 'El usuario se ha creado exitosamente.',
            'user'      => $user->fresh(),
        ], 201);
    }
}
