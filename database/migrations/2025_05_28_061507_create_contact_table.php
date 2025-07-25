<?php
// blogweb/database/migrations/2025_05_28_061507_create_contact_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('content');
            $table->unsignedBigInteger('reply_id')->nullable();

            $table->unsignedBigInteger('created_by')->nullable(); // <--- ADDED: created_by column
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->integer('status')->default(1)->comment('1: Mới, 2: Đã xem, 3: Đang xử lý, 4: Đã trả lời');
            $table->timestamps();
            $table->softDeletes(); // <--- ADDED: Thêm cột deleted_at (nếu chưa có)

            $table->foreign('reply_id')->references('id')->on('contact')->onDelete('set null');
            // CORRECTED: Changed 'users' to 'user' for foreign key reference
            $table->foreign('created_by')->references('id')->on('user')->onDelete('set null'); // <--- CORRECTED
            $table->foreign('updated_by')->references('id')->on('user')->onDelete('set null'); // <--- CORRECTED
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
};
