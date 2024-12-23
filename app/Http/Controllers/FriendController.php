<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Friends/Index', [
            'friends' => auth()->user()->friends,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Friends/Create', [
            'friends' => auth()->user()->receivedFriendRequests,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'to' => 'required|exists:users,id',
        ]);

        $request->user()->sentFriendRequests()->attach($validated['to']);

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $friend)
    {
        throw_if($friend->sentFriendRequests()->where('to', auth()->id())->doesntExist(), new \Exception('This user has not sent you a friend request.'));

        $friend->sentFriendRequests()->updateExistingPivot(auth()->id(), [
            'accepted_at' => now(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
