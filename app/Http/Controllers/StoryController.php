<?php

namespace App\Http\Controllers;

use App\Models\ClientStory;
use Illuminate\View\View;

class StoryController extends Controller
{
    public function index(): View
    {
        return view('pages.stories');
    }

    public function show(ClientStory $story): View
    {
        abort_unless($story->is_published, 404);

        return view('pages.story-show', [
            'story' => $story,
        ]);
    }
}
