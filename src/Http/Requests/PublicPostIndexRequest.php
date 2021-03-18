<?php


namespace Iyngaran\Advertiser\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PublicPostIndexRequest extends FormRequest
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
