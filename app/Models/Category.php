<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Categories cũng có thể soft delete
use App\Traits\BlamesUsers;

class Category extends Model
{
    use HasFactory, SoftDeletes, BlamesUsers; // Thêm SoftDeletes nếu có deleted_at trong migration

    protected $fillable = ['name', 'slug', 'parent_id', 'status', 'created_by', 'updated_by'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
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
