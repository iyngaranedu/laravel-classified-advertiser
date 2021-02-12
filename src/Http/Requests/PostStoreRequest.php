<?php


namespace Iyngaran\Advertiser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostStoreRequest extends FormRequest
{
    public function __construct(Request $request)
    {
        $request->request->add([
            'posted_by' => auth()->user()->id,
            'belongs_to' => auth()->user()->id,
        ]);
    }

    public function authorize(): bool
    {
        return config('classified-advertiser.allow_users_to_post');
    }

    public function rules(): array
    {
        return array_merge(
            [
                'title' => 'required',
                'for' => 'nullable',
                'condition' => 'nullable',
                'short_description' => 'nullable',
                'detail_description' => 'nullable',
                'price' => 'nullable',
                'currency' => 'nullable',
                'negotiable' => 'nullable',
                'category' => 'required',
                'sub_category' => 'required',
                'status' => 'required',
            ],
            config('classified-advertiser.post_fields_validation_rules')
        );
    }
}
