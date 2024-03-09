<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneCodeRequest;
use Domains\Users\Actions\ValidatePhoneCodeAction;

class ValidatePhoneCodeController extends Controller
{
    public function __invoke(PhoneCodeRequest $phoneCodeRequest, ValidatePhoneCodeAction $validatePhoneCodeAction): \Illuminate\Http\JsonResponse
    {
        $response = $validatePhoneCodeAction->run($phoneCodeRequest->all());

        if (is_null($response['token'])){
            return response()->json([
                'message'       => 'Incorrect validation.',
                'is_validated'  => false,
                'user'          => $response['user'],
                'token'         => $response['token']
            ], 401);
        }

        return response()->json([
            'message'       => 'Successful validation.',
            'is_validated'  => true,
            'user'          => $response['user'],
            'token'         => $response['token']
        ], 200);
    }
}
