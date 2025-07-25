<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:1000',
            'slug' => 'nullable|string|max:1000|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'content' => 'required|string',
            'download' => 'nullable|string|max:2048',
            'password' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ];

        // Nếu đang update, bỏ qua slug của chính nó
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['slug'] = 'nullable|string|max:1000|unique:posts,slug,' . $this->route('post')->id;
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'; // Thumbnail không bắt buộc khi update
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 1000 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'thumbnail.image' => 'File thumbnail phải là ảnh.',
            'thumbnail.mimes' => 'Thumbnail phải có định dạng: jpeg, png, jpg, gif, svg.',
            'thumbnail.max' => 'Kích thước thumbnail không được vượt quá 2MB.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'download.max' => 'Đường dẫn download quá dài.',
            'password.max' => 'Mật khẩu không được vượt quá 255 ký tự.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái không hợp lệ.',
        ];
    }
}
