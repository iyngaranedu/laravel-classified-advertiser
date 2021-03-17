<?php


namespace Iyngaran\Advertiser\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
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

    public ?string $city;

    public ?string $state;

    public ?string $country;

    public ?array $geo_location;

    public ?array $contact_numbers;

    public Category $category;

    public Category $sub_category;

    public int $belongs_to;

    public int $posted_by;

    public ?Carbon $posted_at;

    public string $status;

    public string $review_status;

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
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'geo_location' => $request->input('geo_location'),
            'contact_numbers' => $request->input('contact_numbers'),
            'sub_category' => $subCategory,
            'belongs_to' => $request->input('belongs_to'),
            'posted_by' => $request->input('posted_by'),
            'posted_at' => Carbon::now(),
            'status' => $request->input('status') ?: config('classified-advertiser.default_status'),
            'review_status' => config('classified-advertiser.review_status'),
        ]);
    }
}
