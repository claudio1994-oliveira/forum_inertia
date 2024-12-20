<?php

namespace App\Http\Query;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;



class NoRepliesQueryFilter implements Filter
{

    public function __invoke(Builder $query, $value, $property)
    {
        $query->has('posts', '=', 1);
    }
}
