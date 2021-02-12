<?php


namespace Iyngaran\Advertiser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
