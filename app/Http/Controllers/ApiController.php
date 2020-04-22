<?php

namespace App\Http\Controllers;

use App\Institution;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function institutions(): JsonResponse
    {
        $data = [
            'institutions' => Institution::with('teams')->get()
        ];

        return response()->json($data);
    }
}
