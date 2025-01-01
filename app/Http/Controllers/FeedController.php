<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Feed::with('user', 'attachments')->latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
            'attachments' => 'nullable|array',
            'attachments.*' => [
                'required',
                File::image(['jpeg', 'png', 'jpg', 'gif'])->max(2048),
            ],
        ]);

        $feed = $request->user()->feeds()->create([
            'content' => $validated['content'],
        ]);

        if (! empty($validated['attachments'])) {
            $attachments = collect($validated['attachments'])
                ->map(fn ($attachment) => ['path' => $attachment->store('attachments', 'public')])
                ->all();

            $feed->attachments()->createMany($attachments);
        };

        return back()->with('feeds', Feed::with('user', 'attachments')->latest()->get());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
