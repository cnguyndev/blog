<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check(); // Chỉ cho phép người dùng đăng nhập
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|boolean',
        ];

        // Nếu đang update, bỏ qua slug của chính nó
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['slug'] = 'nullable|string|max:255|unique:categories,slug,' . $this->route('category')->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái không hợp lệ.',
        ];
    }
}
