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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            
            $table->unsignedBigInteger("photo_id")->nullable();
            $table->unsignedBigInteger("post_id")->nullable();
            $table->unsignedBigInteger("comment_id")->nullable();

            $table->foreign("user_id")->references("id")->on("users");
            
            $table->foreign("photo_id")->references("id")->on("gallery");
            $table->foreign("post_id")->references("id")->on("posts");
            $table->foreign("comment_id")->references("id")->on("comments");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
