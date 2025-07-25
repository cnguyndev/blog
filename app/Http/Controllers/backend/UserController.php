<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest; // Import Request
use Illuminate\Support\Facades\Hash; // Để hash mật khẩu
use Illuminate\Support\Facades\Auth; // Để kiểm tra người dùng hiện tại

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $trashCount = User::onlyTrashed()->count();

        return view('backend.user.index', compact('users', 'trashCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) // Sử dụng StoreUserRequest
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']); // Hash mật khẩu

        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user) // Sử dụng StoreUserRequest
    {
        $validatedData = $request->validated();

        // Xử lý mật khẩu: Chỉ hash nếu có nhập mật khẩu mới
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Không cập nhật mật khẩu nếu không nhập
        }

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(User $user)
    {
        // Không cho phép xóa chính tài khoản đang đăng nhập
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Bạn không thể xóa tài khoản của chính mình!');
        }

        $user->delete(); // Soft delete

        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công (đã chuyển vào thùng rác)!');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trash()
    {
        $trashedUsers = User::onlyTrashed()->paginate(10);
        return view('backend.user.trash', compact('trashedUsers'));
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.trash')->with('success', 'Khôi phục người dùng thành công!');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Không cho phép xóa vĩnh viễn chính tài khoản đang đăng nhập (nếu nó bị xóa mềm)
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.trash')->with('error', 'Bạn không thể xóa vĩnh viễn tài khoản của chính mình!');
        }

        $user->forceDelete(); // Xóa vĩnh viễn

        return redirect()->route('admin.users.trash')->with('success', 'Xóa vĩnh viễn người dùng thành công!');
    }

    /**
     * Permanently remove all trashed resources from storage.
     */
    public function forceDeleteAll()
    {
        // Có thể thêm kiểm tra không xóa tài khoản admin đang hoạt động nếu nó bị xóa mềm
        $trashedUsers = User::onlyTrashed()->get();
        foreach ($trashedUsers as $user) {
            if (Auth::id() === $user->id) {
                continue; // Bỏ qua tài khoản đang đăng nhập nếu nó có trong thùng rác
            }
            $user->forceDelete();
        }

        return redirect()->route('admin.users.trash')->with('success', 'Đã xóa vĩnh viễn tất cả người dùng trong thùng rác (trừ tài khoản đang đăng nhập nếu có)!');
    }
}
