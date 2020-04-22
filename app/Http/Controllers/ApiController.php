<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Team;
use DateTime;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function institutions(): JsonResponse
    {
        $data = [
            'institutions' => Institution::apiRepresentation()
        ];

        return response()->json($data);
    }

    public function team(Team $team): JsonResponse
    {
        // Convert saved datetime to unix timestamp
        $data = $team->results
                     ->each(fn ($result) => $result->datetime = (new DateTime($result->datetime))->getTimestamp());

        return response()->json($data);
    }
}
