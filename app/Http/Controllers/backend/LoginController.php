<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            // If already logged in, redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }
        return view('backend.login.index'); // Make sure your login view path is correct
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Attempt to log in the user using the default 'web' guard.
        // Laravel's Auth::attempt doesn't inherently care about roles unless you add
        // a custom WHERE clause or guard. Since any authenticated user is allowed,
        // this is fine.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Đăng nhập thành công!');
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->redirectTo(route('admin.login'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất.');
    }
}
