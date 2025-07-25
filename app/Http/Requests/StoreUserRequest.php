<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user,email', // 'user' là tên bảng
            'password' => 'required|string|min:8|confirmed', // 'confirmed' yêu cầu password_confirmation
            'status' => 'required|boolean',
        ];

        // Nếu đang update, bỏ qua email của chính nó và mật khẩu không bắt buộc
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $userId = $this->route('user') ? $this->route('user')->id : null;
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('user')->ignore($userId, 'id')];
            $rules['password'] = 'nullable|string|min:8|confirmed'; // Mật khẩu không bắt buộc
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'status.required' => 'Trạng thái là bắt buộc.',
            'status.boolean' => 'Trạng thái không hợp lệ.',
        ];
    }
}
