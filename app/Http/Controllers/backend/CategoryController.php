<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // <-- Đảm bảo dòng này đã được import
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['parent', 'creator', 'updater'])
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashCount = Category::onlyTrashed()->count();

        return view('backend.category.index', compact('categories', 'trashCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::where('status', 1)->get();
        return view('backend.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        // Tự động tạo slug nếu không nhập hoặc nếu tên thay đổi
        // Đảm bảo slug là duy nhất bằng cách thêm số nếu cần, mặc dù validation request đã kiểm tra unique
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['name']);
        }

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['parent', 'creator', 'updater']);
        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('status', 1)
            ->where('id', '!=', $category->id)
            ->get();
        return view('backend.category.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        // Tự động tạo slug nếu không nhập HOẶC nếu tên danh mục đã thay đổi so với ban đầu
        if (empty($validatedData['slug']) || ($validatedData['name'] !== $category->name && empty($request->input('slug')))) {
            $validatedData['slug'] = Str::slug($validatedData['name']);
        }


        $category->update($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công (đã chuyển vào thùng rác)!');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trash()
    {
        $trashedCategories = Category::onlyTrashed()->with(['updater'])->paginate(10);
        return view('backend.category.trash', compact('trashedCategories'));
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.trash')->with('success', 'Khôi phục danh mục thành công!');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.trash')->with('success', 'Xóa vĩnh viễn danh mục thành công!');
    }

    /**
     * Permanently remove all trashed resources from storage.
     */
    public function forceDeleteAll()
    {
        Category::onlyTrashed()->forceDelete();

        return redirect()->route('admin.categories.trash')->with('success', 'Đã xóa vĩnh viễn tất cả danh mục trong thùng rác!');
    }
}
