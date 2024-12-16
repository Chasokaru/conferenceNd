<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

abstract class Controller
{
    /**
     * Controller constructor.
     *
     * Automatically log the instantiation of a new controller instance.
     */
    public function __construct()
    {
        // Log when a controller instance is created
        Log::info('A new controller instance has been created.', [
            'controller' => static::class,
        ]);
    }

    /**
     * Handle shared logic for controllers.
     *
     * This can be used to enforce common behaviors like middleware or logging.
     */
    protected function commonSetup(): void
    {
        // Example: Automatically apply middleware to all inheriting controllers
        if (method_exists($this, 'middleware')) {
            $this->middleware('auth');
        }

        // Log a common setup action
        Log::info('Common setup logic executed for controller.', [
            'controller' => static::class,
        ]);
    }

    /**
     * Automatically clean up resources or log actions when the controller instance is destroyed.
     */
    public function __destruct()
    {
        // Log the destruction of the controller instance
        Log::info('A controller instance has been destroyed.', [
            'controller' => static::class,
        ]);
    }
}
