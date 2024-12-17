<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Http\Requests\ConferenceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the conferences.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        Log::info('Fetching all conferences for display.');

        $sortField = $request->get('sortField', 'date');
        $sortDirection = $request->get('sortDirection', 'asc');

        // Validate sorting parameters
        if (!in_array($sortField, ['date', 'title']) || !in_array($sortDirection, ['asc', 'desc'])) {
            return redirect()->route('conferences.index')->withErrors('Invalid sorting parameters.');
        }

        $conferences = Conference::orderBy($sortField, $sortDirection)->paginate(10);
        $totalConferences = $conferences->total();

        Log::info("Total conferences retrieved: {$totalConferences}");
        Log::info("Sorting by: {$sortField} in {$sortDirection} order.");

        return view('index', [
            'conferences' => $conferences,
            'totalConferences' => $totalConferences,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }

    /**
     * Show the form for creating a new conference.
     *
     * @return View
     */
    public function create(): View
    {
        Log::info('Loading the conference creation form.');

        return view('create', [
            'instructions' => 'Please ensure all required fields are filled correctly.',
        ]);
    }

    /**
     * Store a newly created conference in storage.
     *
     * @param ConferenceRequest $request
     * @return RedirectResponse
     */
    public function store(ConferenceRequest $request): RedirectResponse
    {
        Log::info('Processing conference creation.', $request->all());

        try {
            $conference = Conference::create($request->validated());
            Log::info("Conference created successfully with ID: {$conference->id}");

            return redirect()->route('conferences.index')
                ->with('success', 'Conference created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating conference:', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors('Failed to create conference.');
        }
    }

    /**
     * Show the form for editing the specified conference.
     *
     * @param Conference $conference
     * @return View
     */
    public function edit(Conference $conference): View
    {
        Log::info("Editing conference with ID: {$conference->id}");

        return view('edit', [
            'conference' => $conference,
            'lastEdited' => now(),
        ]);
    }

    /**
     * Update the specified conference in storage.
     *
     * @param ConferenceRequest $request
     * @param Conference $conference
     * @return RedirectResponse
     */
    public function update(ConferenceRequest $request, Conference $conference): RedirectResponse
    {
        Log::info("Updating conference with ID: {$conference->id}", $request->all());

        try {
            $conference->update($request->validated());
            Log::info("Conference updated successfully with ID: {$conference->id}");

            return redirect()->route('conferences.index')
                ->with('success', 'Conference updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating conference:', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors('Failed to update conference.');
        }
    }

    /**
     * Remove the specified conference from storage.
     *
     * @param Conference $conference
     * @return RedirectResponse
     */
    public function destroy(Conference $conference): RedirectResponse
    {
        Log::info("Deleting conference with ID: {$conference->id}");

        try {
            $conference->delete();
            Log::info("Conference deleted successfully with ID: {$conference->id}");

            return redirect()->route('conferences.index')
                ->with('success', 'Conference deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting conference:', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors('Failed to delete conference.');
        }
    }
}
