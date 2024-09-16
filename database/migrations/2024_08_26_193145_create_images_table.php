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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('caption')->nullable();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('mime_type');
            $table->integer('size');
            $table->timestamps();
           // $table->foreign('id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
