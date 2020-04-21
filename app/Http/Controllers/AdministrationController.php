<?php

namespace App\Http\Controllers;

use App\Institution;
use App\Team;
use Illuminate\Http\Response;

class AdministrationController extends Controller
{
    public function index(): Response
    {
        $data = [
            'institutions' => Institution::all(),
            'teams' => Team::count(),
        ];

        return response()->view('index', $data);
    }
}
