<?php


namespace Iyngaran\Advertiser\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Iyngaran\Category\Models\Category;
use Spatie\DataTransferObject\DataTransferObject;

class PostData extends DataTransferObject
{
    public string $title;

    public ?string $for;

    public ?int $condition;

    public ?string $short_description;

    public ?string $detail_description;

    public ?float $price;

    public ?string $currency;

    public ?int $negotiable;

    public ?string $address;

    public ?int $city;

    public ?int $state;

    public ?int $country;

    public ?array $geo_location;

    public ?array $contact_numbers;

    public Category $category;

    public Category $sub_category;

    public int $belongs_to;

    public int $posted_by;

    public ?Carbon $posted_at;

    public string $status;

    public string $review_status;

    public ?array $default_image;

    public ?array $images;

    public ?int $published_by;

    public ?Carbon $published_at;

    public static function formRequest(FormRequest $request): self
    {
        $category = null;
        $subCategory = null;

        if ($request->input('category')) {
            $category = Category::find($request->input('category'));
        }

        if ($request->input('sub_category')) {
            $subCategory = Category::find($request->input('sub_category'));
        }

        $uploaded_images = $request->input('images');
        $images = [];
        if ($uploaded_images) {
            foreach ($uploaded_images as $index => $uploadedImage) {
                $uploadedImage['display_order'] = $index + 1;
                array_push($images, $uploadedImage);
            }
        }


        return new self([
            'title' => $request->input('title'),
            'for' => $request->input('for'),
            'condition' => (int)$request->input('condition'),
            'short_description' => $request->input('short_description'),
            'detail_description' => $request->input('detail_description'),
            'price' => (double)$request->input('price'),
            'currency' => $request->input('currency'),
            'negotiable' => (int)$request->input('negotiable'),
            'category' => $category,
            'address' => $request->input('address'),
            'city' => (int)$request->input('city'),
            'state' => (int)$request->input('state'),
            'country' => (int)$request->input('country'),
            'geo_location' => $request->input('geo_location'),
            'contact_numbers' => $request->input('contact_numbers'),
            'sub_category' => $subCategory,
            'default_image' => $request->input('default_image'),
            'images' => $request->input('images'),
            'belongs_to' => $request->input('belongs_to'),
            'posted_by' => $request->input('posted_by'),
            'posted_at' => Carbon::now(),
            'status' => $request->input('status') ?: config('classified-advertiser.default_status'),
            'review_status' => $request->input('review_status') ?: config('classified-advertiser.review_status'),
        ]);
    }
}
