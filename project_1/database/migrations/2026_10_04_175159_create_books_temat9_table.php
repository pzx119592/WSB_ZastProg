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
        Schema::create('books_temat9', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->unsignedSmallInteger('year');
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('pages');
            $table->string('publication_place');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_temat9');
    }
};
