<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('topic', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1000);
            $table->string('slug', 1000)->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->unsignedTinyInteger('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('topic');
    }
};
