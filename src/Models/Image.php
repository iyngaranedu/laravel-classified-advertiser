<?php


namespace Iyngaran\Advertiser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $guarded = [];
    protected $table = 'images';

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
