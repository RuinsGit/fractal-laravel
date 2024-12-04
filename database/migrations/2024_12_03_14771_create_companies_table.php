<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->text('text_1_az')->nullable();
            $table->text('text_2_az')->nullable();
            $table->text('text_3_az')->nullable();
            $table->text('text_1_en')->nullable();
            $table->text('text_2_en')->nullable();
            $table->text('text_3_en')->nullable();
            $table->text('text_1_ru')->nullable();
            $table->text('text_2_ru')->nullable();
            $table->text('text_3_ru')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};