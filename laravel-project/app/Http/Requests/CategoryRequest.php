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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:categories,name',
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'カテゴリ名を入力してください',
            'name.max' => 'カテゴリ名は50文字以下で入力してください',
            'name.unique' => 'このカテゴリ名はすでに存在します',
        ];
    }
}
