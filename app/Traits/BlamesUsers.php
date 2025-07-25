<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait BlamesUsers
{
    /**
     * Boot the trait.
     * This method will be called when the model is booted.
     * It sets up model event listeners to automatically populate
     * 'created_by' and 'updated_by' fields.
     */
    protected static function bootBlamesUsers()
    {
        // Sự kiện 'creating' được kích hoạt khi một model mới được tạo (trước khi lưu vào DB)
        static::creating(function ($model) {
            // Kiểm tra xem có người dùng nào đang đăng nhập không
            if (Auth::check()) {
                // Đặt ID của người dùng đăng nhập vào trường 'created_by'
                $model->created_by = Auth::id();
                // Đồng thời đặt ID này vào 'updated_by' khi tạo mới
                $model->updated_by = Auth::id();
            }
        });

        // Sự kiện 'updating' được kích hoạt khi một model hiện có được cập nhật (trước khi lưu vào DB)
        static::updating(function ($model) {
            // Kiểm tra xem có người dùng nào đang đăng nhập không
            if (Auth::check()) {
                // Đặt ID của người dùng đăng nhập vào trường 'updated_by'
                $model->updated_by = Auth::id();
            }
        });

        // Mặc định created_by không được thay đổi khi cập nhật.
        // Tuy nhiên, nếu bạn có logic đặc biệt muốn cập nhật created_by, bạn có thể thêm:
        // static::retrieved(function ($model) {
        //     // Logic nếu cần chỉnh sửa created_by sau khi lấy model
        // });
    }
}
