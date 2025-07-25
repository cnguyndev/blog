<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Vẫn cần nếu dùng trong các phương thức còn lại
use App\Models\Comment;
use App\Models\Post;    // Vẫn cần cho index/show view
use App\Models\User;    // Vẫn cần cho index/show view
use Illuminate\Support\Str; // Vẫn cần nếu dùng Str::limit trong view
// Removed StoreCommentRequest and UpdateCommentRequest as they are not used for create/update

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Comment::with(['post', 'user', 'parent'])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('backend.comment.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     * Removed as per user request.
     */
    // public function create() {}

    /**
     * Store a newly created resource in storage.
     * Removed as per user request.
     */
    // public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::with(['post', 'user', 'parent', 'replies.user'])->findOrFail($id);
        return view('backend.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     * Removed as per user request.
     */
    // public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     * Removed as per user request.
     */
    // public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete(); // This will cascade delete replies due to FK constraint
        return redirect()->route('admin.comment.index')->with('success', 'Xóa bình luận thành công!');
    }
}
