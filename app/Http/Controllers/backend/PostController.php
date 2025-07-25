<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'creator', 'updater'])
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashCount = Post::onlyTrashed()->count();

        return view('backend.post.index', compact('posts', 'trashCount'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $validatedData['slug'] . '.' . $extension;

            $destinationPath = public_path('frontend/images/posts');
            $file->move($destinationPath, $fileName);

            $validatedData['thumbnail'] = $fileName;
        } else {
            $validatedData['thumbnail'] = null;
        }

        Post::create($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công!');
    }

    public function show(Post $post)
    {
        $post->load(['category', 'creator', 'updater']);
        return view('backend.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::where('status', 1)->get();
        return view('backend.post.edit', compact('post', 'categories'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $validatedData = $request->validated();

        if (empty($validatedData['slug']) || ($validatedData['title'] !== $post->title && empty($request->input('slug')))) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        } else if (!empty($validatedData['slug']) && $validatedData['slug'] !== $post->slug) {
            $validatedData['slug'] = Str::slug($validatedData['slug']);
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                $oldPath = public_path('frontend/images/posts/' . $post->thumbnail);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $validatedData['slug'] . '.' . $extension;

            $destinationPath = public_path('frontend/images/posts');
            $file->move($destinationPath, $fileName);

            $validatedData['thumbnail'] = $fileName;
        } else {
            if ($validatedData['slug'] !== $post->slug && $post->thumbnail) {
                $oldFileName = $post->thumbnail;
                $oldExtension = pathinfo($oldFileName, PATHINFO_EXTENSION);
                $newFileName = $validatedData['slug'] . '.' . $oldExtension;

                $oldPath = public_path('frontend/images/posts/' . $oldFileName);
                $newPath = public_path('frontend/images/posts/' . $newFileName);

                if (file_exists($oldPath)) {
                    rename($oldPath, $newPath);
                    $validatedData['thumbnail'] = $newFileName;
                } else {
                    $validatedData['thumbnail'] = $oldFileName;
                }
            } else {
                $validatedData['thumbnail'] = $post->thumbnail;
            }
        }

        $post->update($validatedData);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công (đã chuyển vào thùng rác)!');
    }

    public function trash()
    {
        $trashedPosts = Post::onlyTrashed()->with(['updater'])->paginate(10);
        return view('backend.post.trash', compact('trashedPosts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.trash')->with('success', 'Khôi phục bài viết thành công!');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if ($post->thumbnail) {
            $path = public_path('frontend/images/posts/' . $post->thumbnail);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $post->forceDelete();

        return redirect()->route('admin.posts.trash')->with('success', 'Xóa vĩnh viễn bài viết thành công!');
    }

    public function forceDeleteAll()
    {
        $trashedPosts = Post::onlyTrashed()->get();
        foreach ($trashedPosts as $post) {
            if ($post->thumbnail) {
                $path = public_path('frontend/images/posts/' . $post->thumbnail);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $post->forceDelete();
        }

        return redirect()->route('admin.posts.trash')->with('success', 'Đã xóa vĩnh viễn tất cả bài viết trong thùng rác!');
    }
}
