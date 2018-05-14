<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FilterQuestionType implements Filter
{
    public function __invoke(Builder $query, $type, string $property): Builder
    {
        return $query->with('type')->whereHas('type', function ($q) use ($type) {
            $q->where('slug', $type);
        });
    }
}