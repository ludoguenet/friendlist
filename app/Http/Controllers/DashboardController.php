<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $potentialFriends = auth()->user()->potentialFriends()->latest()->get();

        return Inertia::render('Dashboard', [
            'potentialFriends' => $potentialFriends,
        ]);
    }
}
