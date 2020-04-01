<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "bail|required|max:50",
            "desc" => "max:255",
            "parent_id" => "required|exists:categories",
            "image" => "image|mimes:jpg,png,jpeg|max:5000"
        ];
    }
}
