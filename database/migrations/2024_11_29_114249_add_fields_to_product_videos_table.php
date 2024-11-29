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
        Schema::table('product_videos', function (Blueprint $table) {
            $table->integer('duration')->default(0)->after('video_path');
            $table->integer('download_count')->default(0)->after('duration');
            $table->decimal('rating', 2, 1)->default(5.0)->after('download_count');
            $table->integer('view_count')->default(0)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_videos', function (Blueprint $table) {
            $table->dropColumn(['duration', 'download_count', 'rating', 'view_count']);
        });
    }
};
