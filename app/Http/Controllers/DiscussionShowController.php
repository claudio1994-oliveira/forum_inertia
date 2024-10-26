<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscussionShowController extends Controller
{
    public function __invoke(Discussion $discussion)
    {
        $discussion->load(['topic']);
        return Inertia::render('Forum/Show', ['discussion' => DiscussionResource::make($discussion)]);
    }
}
