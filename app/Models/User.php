<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user'; // Xác nhận tên bảng là 'user' (số ít)

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        // 'created_by', // User model thường không tự blame chính nó
        // 'updated_by', // but if you add these columns, ensure they're here.
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Các mối quan hệ nếu có (ví dụ: các bài viết/danh mục do người dùng này tạo)
    public function postsCreated()
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function categoriesCreated()
    {
        return $this->hasMany(Category::class, 'created_by');
    }

    public function contactsCreated()
    {
        return $this->hasMany(Contact::class, 'created_by');
    }
}
