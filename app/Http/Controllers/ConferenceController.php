<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Http\Requests\ConferenceRequest;

class ConferenceController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $conferences = Conference::all();
        return view('index', compact('conferences'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('create');
    }

    public function store(ConferenceRequest $request): \Illuminate\Http\RedirectResponse
    {
        Conference::create($request->validated());
        return redirect()->route('conferences.index')->with('success', 'Conference created successfully!');
    }

    public function edit(Conference $conference): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('edit', compact('conference'));
    }

    public function update(ConferenceRequest $request, Conference $conference): \Illuminate\Http\RedirectResponse
    {
        $conference->update($request->validated());
        return redirect()->route('conferences.index')->with('success', 'Conference updated successfully!');
    }

    public function destroy(Conference $conference): \Illuminate\Http\RedirectResponse
    {
        $conference->delete();
        return redirect()->route('conferences.index')->with('success', 'Conference deleted successfully!');
    }
}

