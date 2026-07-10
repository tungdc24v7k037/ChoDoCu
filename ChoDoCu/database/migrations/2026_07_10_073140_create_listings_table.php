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
        Schema::create('listings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('category_id')
            ->constrained()
            ->restrictOnDelete();

        $table->string('title');
        $table->string('slug')->unique();
        $table->text('description');

        $table->decimal('price', 15, 0)->nullable();
        $table->boolean('is_negotiable')->default(false);

        $table->string('condition')->default('used');
        $table->string('province');
        $table->string('district')->nullable();
        $table->string('ward')->nullable();
        $table->string('address')->nullable();

        $table->string('phone', 20)->nullable();

        $table->enum('status', [
            'draft',
            'pending',
            'published',
            'sold',
            'rejected',
            'hidden'
        ])->default('pending');

        $table->unsignedBigInteger('views')->default(0);
        $table->timestamp('published_at')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->index(['category_id', 'status']);
        $table->index(['province', 'status']);
        $table->index('price');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
