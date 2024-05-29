<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Http\Requests\ConferenceRequest;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::all();
        return view('index', compact('conferences'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ConferenceRequest $request)
    {
        Conference::create($request->validated());
        return redirect()->route('conferences.index')->with('success', 'Conference created successfully!');
    }

    public function edit(Conference $conference)
    {
        return view('edit', compact('conference'));
    }

    public function update(ConferenceRequest $request, Conference $conference)
    {
        $conference->update($request->validated());
        return redirect()->route('conferences.index')->with('success', 'Conference updated successfully!');
    }

    public function destroy(Conference $conference)
    {
        $conference->delete();
        return redirect()->route('conferences.index')->with('success', 'Conference deleted successfully!');
    }
}

