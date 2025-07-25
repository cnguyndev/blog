<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) { // Table name is 'user' (singular)
            $table->id(); // Creates unsignedBigInteger for 'id'
            $table->string('name')->nullable(); // Added name column, assuming it's nullable or adjust as needed
            $table->string('email', 255)->unique(); // <--- ADDED: Crucial for Laravel's Auth login
            $table->timestamp('email_verified_at')->nullable(); // Optional, but good for auth
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable(); // For "remember me" functionality
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->unsignedTinyInteger('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
