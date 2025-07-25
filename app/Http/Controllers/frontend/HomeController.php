<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Lấy tất cả danh mục cha (và eager load con của chúng)
        $categories = Category::with(['children' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('status', 1)
            ->whereNull('parent_id')
            ->get();

        // 2. Lấy bài viết theo từng danh mục (như logic hiện tại của bạn)
        $categorizedPosts = [];
        foreach ($categories as $category) {
            $categoryIds = [$category->id];
            // Nếu là danh mục cha và có con, thêm ID của con vào mảng
            if ($category->children->count() > 0) {
                foreach ($category->children as $child) {
                    $categoryIds[] = $child->id;
                }
            }

            $postsForThisCategory = Post::whereIn('category_id', $categoryIds)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();

            $categorizedPosts[$category->slug] = $postsForThisCategory;
        }

        // 3. Lấy các bài viết phổ biến
        $popularPosts = Post::where('status', 1)
            ->orderBy('view', 'desc')
            ->limit(3)
            ->get();

        // 4. Lấy các bài viết ngẫu nhiên từ bất kỳ danh mục nào
        // Đây là biến bạn muốn thêm vào:
        $randomPosts = Post::where('status', 1)
            ->inRandomOrder() // Sắp xếp ngẫu nhiên
            ->limit(6)        // Giới hạn số lượng bài viết (ví dụ: 6 bài)
            ->get();

        // 5. Truyền tất cả các biến vào view
        return view('frontend.home', compact('categories', 'categorizedPosts', 'popularPosts', 'randomPosts'));
    }

    public function about()
    {
        return view('frontend.about');
    }
    public function privacy()
    {
        return view('frontend.privacy');
    }
    public function api()
    {
        return view('frontend.api');
    }
}
