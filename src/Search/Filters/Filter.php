<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public static function apply(Builder $builder, $value): Builder;
}
