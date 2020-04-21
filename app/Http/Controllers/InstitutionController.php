<?php

namespace App\Http\Controllers;

use App\Http\Requests\Institutions\DestroyInstitutionRequest;
use App\Http\Requests\Institutions\StoreInstitutionRequest;
use App\Http\Requests\Institutions\UpdateInstitutionRequest;
use App\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class InstitutionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInstitutionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreInstitutionRequest $request): RedirectResponse
    {
        $data = $request->only('name', 'color', 'logo');

        $institution = new Institution($data);
        $institution->save();

        return redirect()->route('institutions.show', $institution);
    }

    /**
     * Display the specified resource.
     *
     * @param Institution $institution
     * @return Response
     */
    public function show(Institution $institution): Response
    {
        $data = [
            'institution' => $institution,
            'teams' => $institution->teams,
        ];

        return response()->view('institutions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Institution $institution
     * @return Response
     */
    public function edit(Institution $institution): Response
    {
        $data = [
            'institution' => $institution
        ];

        return response()->view('institutions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInstitutionRequest $request
     * @param Institution $institution
     * @return RedirectResponse
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution): RedirectResponse
    {
        $data = $request->only('name', 'logo', 'color');

        $institution->update($data);

        return redirect()->route('institutions.show', $institution);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyInstitutionRequest $request
     * @param Institution $institution
     * @return RedirectResponse
     */
    public function destroy(DestroyInstitutionRequest $request, Institution $institution): RedirectResponse
    {
        // The deletion confirmation
        if ($request->input('name') !== $institution->name)
        {
            return redirect()->back()->withErrors("The provided confirmation name does not match.");
        }

        // This will also delete all assigned teams, as there is a foreign key on delete policy
        $institution->delete();

        return redirect()->route('administration.index');
    }
}
