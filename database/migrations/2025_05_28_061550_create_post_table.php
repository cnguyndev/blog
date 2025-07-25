<?php
// blogweb/database/migrations/2025_05_28_061550_create_post_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title', 1000);
            $table->string('slug', 1000)->unique();
            $table->longText('content');
            $table->string('download')->nullable();
            $table->string('password')->nullable();
            $table->integer('view')->default(0);
            $table->string('thumbnail', 1000)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes(); // <--- ADDED: Thêm cột deleted_at
            $table->unsignedTinyInteger('status')->default(1);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('user')->onDelete('set null'); // <--- CORRECTED: references 'user'
            $table->foreign('updated_by')->references('id')->on('user')->onDelete('set null'); // <--- CORRECTED: references 'user'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
