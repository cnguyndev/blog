<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private function getCommonFrontendData()
    {
        $categories = Category::with(['children' => function ($query) {
            $query->where('status', 1);
        }])
            ->where('status', 1)
            ->whereNull('parent_id')
            ->get();

        $popularPosts = Post::where('status', 1)
            ->orderBy('view', 'desc')
            ->limit(5)
            ->get();

        return compact('categories', 'popularPosts');
    }

    public function index()
    {
        $posts = Post::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $currentCategory = null;

        $data = array_merge($this->getCommonFrontendData(), compact('posts', 'currentCategory'));

        return view('frontend.post.post', $data);
    }

    public function detail(string $slug)
    {
        $post = Post::with('category')->where('slug', $slug)->where('status', 1)->first();
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Bài viết không tồn tại hoặc đã bị ẩn!');
        }

        $post->increment('view');

        $other = Post::where('status', 1)
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('view', 'desc')
            ->limit(3)
            ->get();

        $currentCategory = $post->category;
        if ($currentCategory && $currentCategory->parent_id !== 0) {
            $currentCategory->load('parent');
        }

        // Ads HTML (Google AdSense)
        $adsHtml = '<div class="my-8 text-center">
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-xxxxxxxxxxxxxxxx"
                data-ad-slot="1234567890"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        </div>';

        // Inject ads every 3 segments
        $post->content = $this->injectAdsIntoContent($post->content, $adsHtml, 3);

        $data = array_merge($this->getCommonFrontendData(), compact('post', 'other', 'currentCategory'));

        return view('frontend.post.post-detail', $data);
    }

    public function category($slug)
    {
        $currentCategory = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $categoryIds = [$currentCategory->id];

        if ($currentCategory->parent_id == 0 && $currentCategory->children->count() > 0) {
            foreach ($currentCategory->children as $child) {
                $categoryIds[] = $child->id;
            }
        }

        if ($currentCategory->parent_id !== 0) {
            $currentCategory->load('parent');
        }

        $posts = Post::whereIn('category_id', $categoryIds)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = array_merge($this->getCommonFrontendData(), compact('posts', 'currentCategory'));

        return view('frontend.post.category', $data);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = collect();

        if ($query) {
            $posts = Post::where('status', 1)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%')
                        ->orWhere('content', 'like', '%' . $query . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->appends(['query' => $query]);
        }

        $data = array_merge($this->getCommonFrontendData(), compact('posts', 'query'));
        $data['currentCategory'] = null;

        return view('frontend.post.search', $data);
    }

    /**
     * Inject AdSense ads into HTML content after every N tags (p, h2, ul, ol...)
     */
    private function injectAdsIntoContent($html, $adsCode, $everyNth = 3)
    {
        // Tìm các thẻ khối nội dung chính
        preg_match_all('/(<(p|ul|ol|h2|h3|h4)[^>]*>.*?<\/\2>)/si', $html, $matches);

        $segments = $matches[1];
        $output = '';
        $counter = 0;

        foreach ($segments as $index => $block) {
            $output .= $block;
            $counter++;

            if ($counter % $everyNth === 0) {
                $output .= $adsCode;
            }
        }

        return $output;
    }
}
