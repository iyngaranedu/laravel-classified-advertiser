<?php


namespace Iyngaran\Advertiser\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Iyngaran\Category\Models\Category as CategoryModel;

class Category extends CategoryModel
{
    use HasFactory;

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
