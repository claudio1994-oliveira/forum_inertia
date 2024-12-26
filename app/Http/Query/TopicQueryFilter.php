<?php

namespace App\Http\Query;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;
class TopicQueryFilter implements Filter
{

    public function __invoke(Builder $query, mixed $value, string $property)
    {
       $query->whereHas('topic', function ($query) use ($value) {
           $query->where('slug', $value);
       });
    }
}
