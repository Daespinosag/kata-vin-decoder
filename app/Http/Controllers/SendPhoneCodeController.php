<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneRequest;
use Domains\Users\Actions\ResendPhoneCodeAction;
use Illuminate\Http\Request;

class SendPhoneCodeController extends Controller
{
    public function __invoke(PhoneRequest $phoneRequest, ResendPhoneCodeAction $resendPhoneCodeAction)
    {
        $user = $resendPhoneCodeAction->run($phoneRequest->all());

        return response()->json([
            'message'   => 'Codigo enviado nuevamente.',
            'user'      => $user,
        ], 201);
    }
}
