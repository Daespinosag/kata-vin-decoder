<?php

namespace App\Http\Controllers;

use App\Http\Requests\VinRequest;
use Domains\Vin\VinValidateAction;

class VinValidateController extends Controller
{
    public function __invoke(VinRequest $vinRequest, VinValidateAction $vinValidateAction): \Illuminate\Http\JsonResponse
    {
        $result = $vinValidateAction->run($vinRequest->vin_code);

        if (in_array('VIN', array_keys($result))){
            return response()->json($result, 200);
        }

        return response()->json($result, 400);

    }
}
