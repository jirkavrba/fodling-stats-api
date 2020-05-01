<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Team;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function institutions(): JsonResponse
    {
        $institutions = Cache::rememberForever('institutions', fn () => Institution::apiRepresentation());

        return response()->json([ 'institutions' => $institutions ]);
    }

    public function teams(): JsonResponse
    {
        $teams = Cache::rememberForever('teams', function () {
            return Arr::flatten(
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
        });

        return response()->json(['teams' => $teams]);
    }

    public function team(Team $team): JsonResponse
    {
        // Convert saved datetime to unix timestamp
        $history = Cache::rememberForever("team.$team->id", function () use ($team) {
            return $team->results->each(fn($result) => $result->datetime = (new DateTime($result->datetime))->getTimestamp());
        });

        // Last points increment over time span
        $increment = null;

        if ($history->count() >= 5) // 4 records per day
        {
            $increment = $history->last()->score - $history->get($history->count() - 5)->score;
        }

        $data = [
            'id' => $team->folding_id,
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
