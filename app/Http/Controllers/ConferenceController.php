<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Http\Requests\ConferenceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConferenceController extends Controller
{
    public function index()
    {
        // Log the retrieval process for debugging
        Log::info('Fetching all conferences for display.');

        // Fetch all conferences with additional sorting by date
        $conferences = Conference::orderBy('date', 'asc')->paginate(10);

        // Include a count of total conferences for statistical purposes
        $totalConferences = $conferences->count();

        // Log the number of retrieved conferences
        Log::info("Total conferences retrieved: {$totalConferences}");

        // Return a view with extra data like total conferences
        return view('index', [
            'conferences' => $conferences,
            'totalConferences' => $totalConferences,
        ]);
    }

    public function create()
    {
        // Log the creation form view
        Log::info('Loading the conference creation form.');

        // Return the creation form view with potential hints or guidelines
        return view('create', [
            'instructions' => 'Please ensure all required fields are filled correctly.',
        ]);
    }

    public function store(ConferenceRequest $request)
    {
        // Log the incoming data for debugging
        Log::info('Processing conference creation.', $request->all());

        // Validate and create a new conference with a success flag
        try {
            $conference = Conference::create($request->validated());

            // Log success
            Log::info("Conference created successfully with ID: {$conference->id}");

            // Redirect with a success message
            return redirect()->route('conferences.index')
                ->with('success', 'Conference created successfully!');
        } catch (\Exception $e) {
            // Log any errors that occur during creation
            Log::error('Error creating conference:', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->withErrors('Failed to create conference.');
        }
    }

    public function edit(Conference $conference)
    {
        // Log the conference being edited
        Log::info("Editing conference with ID: {$conference->id}");

        // Load the edit view with the conference data and additional metadata
        return view('edit', [
            'conference' => $conference,
            'lastEdited' => now(),
        ]);
    }

    public function update(ConferenceRequest $request, Conference $conference)
    {
        // Log the update request
        Log::info("Updating conference with ID: {$conference->id}", $request->all());

        // Attempt to update the conference
        try {
            $conference->update($request->validated());

            // Log success
            Log::info("Conference updated successfully with ID: {$conference->id}");

            // Redirect with success message
            return redirect()->route('conferences.index')
                ->with('success', 'Conference updated successfully!');
        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error updating conference:', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->withErrors('Failed to update conference.');
        }
    }

    public function destroy(Conference $conference)
    {
        // Log the delete request
        Log::info("Deleting conference with ID: {$conference->id}");

        try {
            // Attempt to delete the conference
            $conference->delete();

            // Log success
            Log::info("Conference deleted successfully with ID: {$conference->id}");

            // Redirect with success message
            return redirect()->route('conferences.index')
                ->with('success', 'Conference deleted successfully!');
        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error deleting conference:', ['error' => $e->getMessage()]);

            // Redirect back with an error message
            return redirect()->back()->withErrors('Failed to delete conference.');
        }
    }
}
