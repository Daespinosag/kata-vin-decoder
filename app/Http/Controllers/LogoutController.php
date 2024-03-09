<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Has salido de la cuenta',
        ], 200);
    }
}
