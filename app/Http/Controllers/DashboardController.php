<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $potentialFriends = User::query()
            ->potentialFriends(auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Dashboard', [
            'potentialFriends' => $potentialFriends,
        ]);
    }
}
