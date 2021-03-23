<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Featured implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('marked_as_featured', $value);
    }
}
