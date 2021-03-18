<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Country implements Filter
{

    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('country', $value);
    }
}
