<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BlamesUsers;

class Post extends Model
{
    use HasFactory, SoftDeletes, BlamesUsers;

    protected $table = 'posts'; // Xác nhận tên bảng là 'posts' (số nhiều)

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'view',
        'status',
        'created_by',
        'updated_by',
        'download',
        'password',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
