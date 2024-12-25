<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FriendController extends Controller
{
    public function index()
    {
        return Inertia::render('Friends/Index', [
            'friends' => auth()->user()->friends()->get(),
        ]);
    }

    public function requestFriends()
    {
        return Inertia::render('Friends/RequestFriends', [
            'requestFriends' => auth()->user()->receivedPendingFriends()->get(),
        ]);
    }

    public function request(Request $request, User $friend)
    {
        auth()->user()->fromPendingFriends()->syncWithoutDetaching($friend);

        return redirect()->back();
    }

    public function accept(User $friend)
    {
        abort_if(auth()->user()->receivedPendingFriends()->where('from', $friend->id)->doesntExist(), 403);

        auth()->user()->receivedPendingFriends()->updateExistingPivot($friend, [
            'accepted_at' => now(),
        ]);

        return redirect()->back();
    }
}
