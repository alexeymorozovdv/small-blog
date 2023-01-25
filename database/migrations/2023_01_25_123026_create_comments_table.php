<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')->nullable(false)
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->foreignId('user_id')->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreignId('published_by')->nullable()
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->string('content', 500)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
