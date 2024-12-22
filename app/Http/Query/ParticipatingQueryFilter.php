<?php

namespace App\Http\Query;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;



class ParticipatingQueryFilter implements Filter
{

    public function __invoke(Builder $query, $value, $property)
    {
        if (! auth()->user()) {
            return;
        }

        $query->whereHas('posts', function (Builder $query) {
            $query
                ->where('user_id', '!=', auth()->id())
                ->whereBelongsTo(auth()->user());
        });
    }
}
