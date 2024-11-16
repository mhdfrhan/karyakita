<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('pages');
            $table->decimal('old_price', 12, 2)->nullable();
            $table->decimal('price', 12, 2);
            $table->string('file_path')->nullable();
            $table->string('slug');
            $table->string('tags')->nullable();
            $table->enum('status', ['draft', 'published', 'suspended'])->default('draft');
            $table->string('preview_url')->nullable();
            $table->boolean('admin_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
