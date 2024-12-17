<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        // Log when the login form is accessed
        Log::info('Login form accessed by a user.');

        // Return the login view with additional hints or tips
        return view('.login', [
            'instructions' => 'Enter your username and password to log in.',
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Log the login attempt
        Log::info('Login attempt by user.', ['username' => $request->username]);

        // Attempt to authenticate with the provided credentials
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Log successful authentication
            Log::info('User authenticated successfully.', ['username' => $request->username]);

            // Regenerate the session ID for security
            $request->session()->regenerate();

            // Redirect to the intended URL with a success message
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // Log failed authentication
        Log::warning('Failed login attempt.', ['username' => $request->username]);

        // Redirect back with error messages
        return redirect()->back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log the logout action
        Log::info('User logged out.', ['username' => Auth::user()->username ?? 'Guest']);

        // Perform the logout operation
        Auth::logout();

        // Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the CSRF token for security
        $request->session()->regenerateToken();

        // Redirect to the homepage with a goodbye message
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
