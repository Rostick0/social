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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // REQUIRED
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('status')->nullable();
            $table->integer('age')->nullable();

            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')->references("id")->on("files")->nullable();

            $table->string('email')->nullable();
            $table->string('password'); // REQUIRED
            $table->string('phone')->unique(); // REQUIRED

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
