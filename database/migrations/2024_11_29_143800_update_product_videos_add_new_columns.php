<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductVideosAddNewColumns extends Migration
{
    public function up()
    {
        Schema::table('product_videos', function (Blueprint $table) {
            $table->string('title')->nullable()->after('product_id');
            $table->integer('duration')->default(0)->after('video_path');
            $table->integer('order')->default(0)->after('duration');
            $table->integer('download_count')->default(0)->after('order');
            $table->integer('view_count')->default(0)->after('download_count');
            $table->integer('rating')->default(5)->after('view_count');
        });
    }

    public function down()
    {
        Schema::table('product_videos', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'duration',
                'order',
                'download_count',
                'view_count',
                'rating'
            ]);
        });
    }
}