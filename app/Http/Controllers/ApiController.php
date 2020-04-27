<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Team;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    public function institutions(): JsonResponse
    {
        return response()->json([
            'institutions' => Institution::apiRepresentation()
        ]);
    }

    public function teams(): JsonResponse
    {
        $teams = Arr::flatten(
            // Map all institutions' teams to respect their logo/color
            Institution::apiRepresentation()->map(
                function ($institution) {
                    return $institution->teams->each(function ($team) use ($institution) {
                        $team['logo'] = $institution->logo;
                        $team['color'] = $institution->color;
                    });
                }
            )
        );

        return response()->json(['teams' => $teams]);
    }

    public function team(Team $team): JsonResponse
    {
        // Convert saved datetime to unix timestamp
        $history = $team->results->each(fn($result) => $result->datetime = (new DateTime($result->datetime))->getTimestamp());

        // Last points increment over time span
        $increment = null;

        if ($history->count() >= 2)
        {
            $increment = $history->last()->score - $history->get($history->count() - 2)->score;
        }

        $data = [
            'id'  => $team->folding_id,
            'name' => $team->name,
            'logo' => $team->institution->logo,
            'color' => $team->institution->color,
            'type' => $team->type,
            'increment' => $increment,
            'history' => $history,
        ];

        return response()->json($data);
    }
}
