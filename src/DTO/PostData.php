<?php


namespace Iyngaran\Advertiser\DTO;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Iyngaran\Category\Models\Category;
use Iyngaran\Category\Repositories\CategoryRepositoryInterface;
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
            $category = App::make(CategoryRepositoryInterface::class)->find(
                $request->input('category')
            );
        }

        if ($request->input('sub_category')) {
            $subCategory = App::make(CategoryRepositoryInterface::class)->find(
                $request->input('sub_category')
            );
        }

        return new self([
            'title' => $request->input('title'),
            'for' => $request->input('for'),
            'condition' => $request->input('condition'),
            'short_description' => $request->input('short_description'),
            'detail_description' => $request->input('detail_description'),
            'price' => $request->input('price'),
            'currency' => $request->input('currency'),
            'negotiable' => (int)$request->input('negotiable'),
            'category' => $category,
            'sub_category' => $subCategory,
            'belongs_to' => $request->input('belongs_to'),
            'posted_by' => $request->input('posted_by'),
            'posted_at' => Carbon::now(),
            'status' => $request->input('status'),
            'review_status' => config('classified-advertiser.review_status'),
        ]);
    }
}
