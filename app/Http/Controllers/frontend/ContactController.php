<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Để log lỗi

class ContactController extends Controller
{
    /**
     * Hiển thị trang liên hệ.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * Xử lý gửi form liên hệ.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'first_name.required' => 'Vui lòng nhập Tên.',
            'last_name.required' => 'Vui lòng nhập Họ.',
            'email.required' => 'Vui lòng nhập Email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'message.required' => 'Vui lòng nhập Tin nhắn.',
            'message.max' => 'Tin nhắn không được vượt quá 1000 ký tự.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Vui lòng kiểm tra lại thông tin bạn đã nhập.');
        }

        try {
            Contact::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'content' => $request->message,
                'status' => 0,
            ]);

            return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi lưu thông tin liên hệ: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra khi gửi tin nhắn của bạn. Vui lòng thử lại sau.');
        }
    }
}
