<?php


namespace Iyngaran\Advertiser\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'title' => $this->title,
                'for' => $this->for,
                'condition' => $this->condition,
                'short_description' => $this->short_description,
                'detail_description' => $this->detail_description,
                'price' => $this->price,
                'currency' => $this->currency,
                'negotiable' => $this->negotiable,
                'category' => $this->category,
                'sub_category' => $this->subCategory,
                'belongs_to' => $this->belongs_to,
                'posted_by' => $this->posted_by,
                'posted_at' => $this->posted_at,
                'status' => $this->status,
                'published_by' => $this->published_by,
                'published_at' => $this->published_at,
                'review_status' => $this->review_status,
                'reviewed_by' => $this->reviewed_by,
            ],
        ];
    }
}
