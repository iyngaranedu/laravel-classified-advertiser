<?php


namespace Iyngaran\Advertiser\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Iyngaran\Advertiser\Casts\Json;

class Post extends Model
{
    use HasFactory;

    protected $table = 'classified_posts';
    protected $guarded = [];

    const CONDITION_USED = 1;
    const CONDITION_NEW = 2;

    const FOR_RENT = 'for-rent';
    const FOR_SALE = 'for-sale';
    /**
     * @var mixed|string
     */
    private $status;

    protected $casts = [
        'geo_location' => Json::class,
        'contact_numbers' => Json::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            "category_id",
            "id"
        );
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            "sub_category_id",
            "id"
        );
    }

    public function markAsPublished(): Post
    {
        $this->status = 'Published';
        $this->save();

        return $this;
    }

    public function markAsDrafted(): Post
    {
        $this->status = 'Drafted';
        $this->save();

        return $this;
    }

    public function markAsPending(): Post
    {
        $this->status = 'Pending';
        $this->save();

        return $this;
    }
}
