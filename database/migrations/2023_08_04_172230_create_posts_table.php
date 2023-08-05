<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema::create('posts', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('content');
        //     $table->integer('likes')->default(0);
        //     $table->integer('comments')->default(0);
        //     $table->integer('views')->default(0);
        //     $table->foreignId('theme_id')->nullable()->constrained();
        //     $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        // Schema::dropIfExists('posts');
    }
};
