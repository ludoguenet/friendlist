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
            ->whereNot('users.id', auth()->id())
            ->whereRaw('(select count(*) from friend_requests where `from` = users.id) = 0')
            ->whereRaw('(select count(*) from friend_requests where `to` = users.id) = 0')
            ->latest()
            ->get();

        return Inertia::render('Dashboard', [
            'potentialFriends' => $potentialFriends,
        ]);
    }
}
