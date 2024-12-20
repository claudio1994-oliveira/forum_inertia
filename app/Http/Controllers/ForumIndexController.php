<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Query\NoRepliesQueryFilter;
use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Request;

class ForumIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        return inertia()->render('Forum/Index', [
            'query' => (object) $request->query(),
            'discussions' => DiscussionResource::collection(
                QueryBuilder::for(Discussion::class)
                    ->allowedFilters(
                        $this->allowedFilters(),
                    )
                    ->with(['topic', 'post', 'latestPost.user', 'participants'])
                    ->withCount('replies')
                    ->orderByPinned()
                    ->orderByLastPost()
                    ->paginate(10)
                    ->appends($request->query())

            ),
        ]);
    }

    protected function allowedFilters()
    {
        return [
            AllowedFilter::custom('noreplies', new NoRepliesQueryFilter),

        ];
    }
}
