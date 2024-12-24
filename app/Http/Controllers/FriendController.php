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
            'friends' => User::all(),
        ]);
    }

    public function requestFriends()
    {
        return Inertia::render('Friends/RequestFriends', [
            'requestFriends' => User::all(),
        ]);
    }

    public function request(Request $request)
    {
        //
    }

    public function accept(User $friend)
    {
        //
    }
}
