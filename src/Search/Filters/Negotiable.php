<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class Negotiable implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('negotiable', $value);
    }
}
