<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $potentialFriends = auth()->user()->potentialFriends(auth()->id())->latest()->get();

        return Inertia::render('Dashboard', [
            'potentialFriends' => $potentialFriends,
        ]);
    }
}
