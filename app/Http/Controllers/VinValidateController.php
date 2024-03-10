<?php

namespace App\Http\Controllers;

use App\Http\Requests\VinRequest;
use Domains\Vin\VinValidateAction;

class VinValidateController extends Controller
{

    private array $vehicleData = [
        "4WD/AWD" => [
            "unit" => "",
            "value" => "",
        ],
        "ABS_Brakes" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "AM/FM_Radio" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Adjustable_Foot_Pedals" => [
            "unit" => "",
            "value" => "",
        ],
        "Air_Conditioning" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Alloy_Wheels" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Anti-Brake_System" => [
            "unit" => "",
            "value" => "4-Wheel ABS",
        ],
        "Automatic_Headlights" => [
            "unit" => "",
            "value" => "",
        ],
        "Automatic_Load-Leveling" => [
            "unit" => "",
            "value" => "",
        ],
        "Body_Style" => [
            "unit" => "",
            "value" => "SEDAN 4-DR",
        ],
        "CD_Changer" => [
            "unit" => "",
            "value" => "Opt.",
        ],
        "CD_Player" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Cargo_Area_Cover" => [
            "unit" => "",
            "value" => "",
        ],
        "Cargo_Area_Tiedowns" => [
            "unit" => "",
            "value" => "",
        ],
        "Cargo_Net" => [
            "unit" => "",
            "value" => "",
        ],
        "Cassette_Player" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Child_Safety_Door_Locks" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Chrome_Wheels" => [
            "unit" => "",
            "value" => "",
        ],
        "Cruise_Control" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Curb_Weight-automatic" => [
            "unit" => "lbs",
            "value" => "3415",
        ],
        "Curb_Weight-manual" => [
            "unit" => "lbs",
            "value" => "No data",
        ],
        "DVD_Player" => [
            "unit" => "",
            "value" => "",
        ],
        "Daytime_Running_Lights" => [
            "unit" => "",
            "value" => "",
        ],
        "Deep_Tinted_Glass" => [
            "unit" => "",
            "value" => "",
        ],
        "Driveline" => [
            "unit" => "",
            "value" => "FWD",
        ],
        "Driver_Airbag" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Driver_Multi-Adjustable_Power_Seat" => [
            "unit" => "",
            "value" => "Std.",
        ],
        "Electrochromic_Exterior_Rearview_Mirror" => [
            "unit" => "",
            "value" => "",
        ],
        "Electrochromic_Interior_Rearview_Mirror" => [
            "unit" => "",
            "value" => "",
        ],
        "Electronic_Brake_Assistance" => [
            "unit" => "",
            "value" => "",
        ],
        "Electronic_Parking_Aid" => [
            "unit" => "",
            "value" => "",
        ],
        "Engine_Displacement" => [
            "unit" => "liter",
            "value" => "3.0",
        ],
        "Engine_Shape" => [
            "unit" => "",
            "value" => "V6",
        ],
        "Engine_Type" => [
            "unit" => "",
            "value" => "3.0L V6 DOHC 24V",
        ],
        "Wind_Deflector_for_Convertibles" => [
            "unit" => "",
            "value" => "",
        ],
    ];
    public function __invoke(VinRequest $vinRequest, VinValidateAction $vinValidateAction): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->vehicleData, 200);

//        $result = $vinValidateAction->run($vinRequest->vin_code);
//
//        if (in_array('VIN', array_keys($result))){
//            return response()->json($result, 200);
//        }
//
//        return response()->json($result, 400);

    }
}
