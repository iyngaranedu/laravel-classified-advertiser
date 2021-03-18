<?php


namespace Iyngaran\Advertiser\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

class SubCategoryId implements Filter
{
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('sub_category_id', $value);
    }
}
