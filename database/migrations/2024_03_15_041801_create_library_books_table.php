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
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->unsigned()->constrained()->cascadeOnDelete();
            $table->string('title')->index();
            $table->string('author')->index();
            $table->string('isbn')->unique()->index();
            $table->unsignedInteger('price')->index();
            $table->unsignedInteger('qty')->index()->default(0);
            $table->datetime('published_at')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
