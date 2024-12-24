<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        return Inertia::render('Friends/Index', [
            'friends' => auth()->user()->friends,
        ]);
    }

    public function requestFriends()
    {
        return Inertia::render('Friends/RequestFriends', [
            'requestFriends' => auth()->user()->receivedFriendRequests,
        ]);
    }

    public function request(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|exists:users,id',
        ]);

        $request->user()->sentFriendRequests()->attach($validated['to']);

        return to_route('dashboard');
    }

    public function accept(User $friend)
    {
        throw_if($friend->sentFriendRequests()->where('to', auth()->id())->doesntExist(), new \Exception('This user has not sent you a friend request.'));

        $friend->sentFriendRequests()->updateExistingPivot(auth()->id(), [
            'accepted_at' => now(),
        ]);
    }
}
