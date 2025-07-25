<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Add your authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $topicsTableName = 'topic'; 

        return [
            'name' => 'required|string|max:1000|unique:' . $topicsTableName . ',name',
            'slug' => 'nullable|string|max:1000|unique:' . $topicsTableName . ',slug', 
            'sort_order' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|boolean', 
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên chủ đề không được để trống.',
            'name.string' => 'Tên chủ đề phải là chuỗi ký tự.',
            'name.max' => 'Tên chủ đề không được vượt quá 1000 ký tự.',
            'name.unique' => 'Tên chủ đề này đã tồn tại.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 1000 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'sort_order.required' => 'Thứ tự sắp xếp không được để trống.',
            'sort_order.integer' => 'Thứ tự sắp xếp phải là số nguyên.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'status.required' => 'Trạng thái không được để trống.',
            'status.boolean' => 'Trạng thái không hợp lệ.',
        ];
    }

    /**
     * Prepare the data for validation.
     * Tự động tạo slug từ trường 'name'.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
