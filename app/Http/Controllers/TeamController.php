<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teams\StoreTeamRequest;
use App\Http\Requests\Teams\UpdateTeamRequest;
use App\Institution;
use App\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Institution $institution
     * @return Response
     */
    public function create(Institution $institution): Response
    {
        $data = [
            'institution' => $institution
        ];

        return response()->view('teams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeamRequest $request
     * @param Institution $institution
     * @return RedirectResponse
     */
    public function store(StoreTeamRequest $request, Institution $institution): RedirectResponse
    {
        $data = [
            'name' => $request->input('name'),
            'folding_id' => $request->input('folding_id'),
            'institution_id' => $institution->id,
        ];

        $team = new Team($data);
        $team->save();

        return redirect()->route('institutions.show', $institution);
    }

    /**
     * Display the specified resource.
     *
     * @param Institution $institution
     * @param Team $team
     * @return void
     */
    public function show(Institution $institution, Team $team): Response
    {
        $data = [
            'institution' => $institution,
            'team' => $team,
            'results' => $team->results
        ];

        return response()->view('teams.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Institution $institution
     * @param Team $team
     * @return Response
     */
    public function edit(Institution $institution, Team $team): Response
    {
        $data = [
            'institution' => $institution,
            'team' => $team,
        ];

        return response()->view('teams.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeamRequest $request
     * @param Institution $institution
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(UpdateTeamRequest $request, Institution $institution, Team $team): RedirectResponse
    {
        if ($request->input('folding_id') !== $team->folding_id)
        {
            $team->results()->delete();
        }

        $data = $request->only('name', 'folding_id', 'type');
        $team->update($data);

        return redirect()->route('institutions.teams.show', [$institution, $team]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Institution $institution
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Institution $institution, Team $team): RedirectResponse
    {
        // This will also delete the score history
        $team->delete();

        return redirect()->route('institutions.show', $institution);
    }
}
