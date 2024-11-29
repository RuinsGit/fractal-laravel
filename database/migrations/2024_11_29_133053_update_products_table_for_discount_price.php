<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVideosTable extends Migration
{
    public function up()
    {
        Schema::create('product_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('video_path');
            $table->integer('duration')->default(0);
            $table->integer('order')->default(0);
            $table->integer('download_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('rating')->default(5);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_videos');
    }
}