<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscussionShowController extends Controller
{
    public function __invoke(Discussion $discussion)
    {
        $discussion->load(['topic']);
        $discussion->loadCount('replies');
        return Inertia::render('Forum/Show', [
            'query' => (object)request()->query(),
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(Post::whereBelongsTo($discussion)
                ->with(['user', 'discussion'])
                ->paginate(10)),
        ]);
    }
}
