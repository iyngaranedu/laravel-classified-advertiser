<?php


namespace Iyngaran\Advertiser\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'for' => $this->for,
            'condition' => $this->condition,
            'short_description' => $this->short_description,
            'detail_description' => $this->detail_description,
            'price' => $this->price,
            'currency' => $this->currency,
            'negotiable' => $this->negotiable,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'geo_location' => $this->geo_location,
            'contact_numbers' => $this->contact_numbers,
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
            'reviewed_at' => $this->reviewed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_at_diff_for_humans' => $this->updated_at ? $this->updated_at->diffForHumans() : null,
            'posted_at_diff_for_humans' => $this->posted_at ? $this->posted_at->diffForHumans() : null,
            'published_at_diff_for_humans' => $this->published_at ? $this->published_at->diffForHumans() : null,
            'reviewed_at_diff_for_humans' => $this->reviewed_at ? $this->reviewed_at->diffForHumans() : null,
            'created_at_diff_for_humans' => $this->created_at ? $this->created_at->diffForHumans() : null,
        ];
    }
}
