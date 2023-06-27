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
        Schema::create('book_user_rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->unsignedInteger('rating');
            $table->text('comment')->nullable();
            $table->boolean('is_favorite')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_user_rating', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('book_user_rating');
    }
};
