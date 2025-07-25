<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Giả sử Dashboard cần số liệu
use App\Models\Post;
use App\Models\User;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy số liệu thống kê cơ bản cho dashboard
        $totalCategories = Category::count();
        $totalPosts = Post::count();
        $totalUsers = User::count();
        $totalContacts = Contact::where('status', 1)->count(); // Số liên hệ mới/chưa xử lý

        $latestPosts = Post::with(['category', 'creator']) // Eager load category và creator
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('backend.dashboard.index', compact(
            'totalCategories',
            'totalPosts',
            'totalUsers',
            'totalContacts',
            'latestPosts'
        ));
    }
}
