<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BlamesUsers;

class Contact extends Model
{
    use HasFactory, SoftDeletes, BlamesUsers;

    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'content',
        'reply_id',
        'status',
        'created_by', // Thêm created_by vào đây
        'updated_by',
    ];

    public function replyTo()
    {
        return $this->belongsTo(Contact::class, 'reply_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Contact::class, 'reply_id', 'id');
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
