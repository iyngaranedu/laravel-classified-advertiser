<?php


namespace Iyngaran\Advertiser\Models;

use Iyngaran\Category\Models\Category as CategoryModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends CategoryModel
{
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
