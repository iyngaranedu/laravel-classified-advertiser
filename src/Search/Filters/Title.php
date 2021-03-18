<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Title implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('title', 'like', $value."%");
    }
}
