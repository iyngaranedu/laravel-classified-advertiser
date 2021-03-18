<?php


namespace Iyngaran\Advertiser\Search\Filters;


use Illuminate\Database\Eloquent\Builder;

class CategoryId implements Filter
{

    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('category_id', $value);
    }
}
