<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\File;

class FeedController extends Controller
{
    public function index()
    {
        return Feed::with('user', 'attachments')->latest()->get();
    }

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
                ->map(static fn (UploadedFile $attachment) => ['path' => $attachment->store('attachments', 'public')])
                ->all();

            $feed->attachments()->createMany($attachments);
        };

        return back();
    }
}
