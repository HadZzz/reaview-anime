<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('title');
            $table->string('title_japanese')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('episodes')->nullable();
            $table->string('status')->nullable();
            $table->float('rating')->nullable();
            $table->json('genres')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
}; 