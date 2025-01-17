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
        Schema::create('commets', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('post_id');                          first version
            // $table->foreign('post_id')->references('id')->on('posts');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');     // second version 
            $table->foreignId('user_id')->constrained();
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commets');
    }
};
