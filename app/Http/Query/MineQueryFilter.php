<?php

namespace App\Http\Query;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;



class MineQueryFilter implements Filter
{

    public function __invoke(Builder $query, $value, $property)
    {
        if (! auth()->user()) {
            return;
        }

        $query->whereBelongsTo(auth()->user());
    }
}
