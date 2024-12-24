<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $potentialFriends = User::query()->get();

        return Inertia::render('Dashboard', [
            'potentialFriends' => $potentialFriends,
        ]);
    }
}
