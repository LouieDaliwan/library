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
        Schema::create('user_book', function (Blueprint $table) {
            $table->foreignId('library_book_id');
            $table->foreignId('user_id');
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('library_book_id')->references('id')->on('library_books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_book');
    }
};
