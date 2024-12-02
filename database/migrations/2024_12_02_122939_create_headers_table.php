<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            
            // 9 ana menü elemanı (3 dilde)
            $table->string('home_az')->nullable();
            $table->string('home_en')->nullable();
            $table->string('home_ru')->nullable();
            
            $table->string('about_az')->nullable();
            $table->string('about_en')->nullable();
            $table->string('about_ru')->nullable();
            
            $table->string('vision_az')->nullable();
            $table->string('vision_en')->nullable();
            $table->string('vision_ru')->nullable();
            
            $table->string('history_az')->nullable();
            $table->string('history_en')->nullable();
            $table->string('history_ru')->nullable();
            
            $table->string('leadership_az')->nullable();
            $table->string('leadership_en')->nullable();
            $table->string('leadership_ru')->nullable();
            
            $table->string('services_az')->nullable();
            $table->string('services_en')->nullable();
            $table->string('services_ru')->nullable();
            
            $table->string('our_services_az')->nullable();
            $table->string('our_services_en')->nullable();
            $table->string('our_services_ru')->nullable();
            
            $table->string('courses_az')->nullable();
            $table->string('courses_en')->nullable();
            $table->string('courses_ru')->nullable();
            
            $table->string('education_program_az')->nullable();
            $table->string('education_program_en')->nullable();
            $table->string('education_program_ru')->nullable();
            
            // Resim
            $table->string('image')->nullable();
            
            // Durum ve Sıralama
            $table->boolean('status')->default(true)->index();
            $table->integer('order')->default(0)->index();
            
            $table->timestamps();
        });

        // 3. menü için ekstra isimler (Vision)
        Schema::create('header_vision_extras', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 4. menü için ekstra isimler (History)
        Schema::create('header_history_extras', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 9. menü için ekstra isimler (Education Program)
        Schema::create('header_education_extras', function (Blueprint $table) {
            $table->id();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('header_education_extras');
        Schema::dropIfExists('header_history_extras');
        Schema::dropIfExists('header_vision_extras');
        Schema::dropIfExists('headers');
    }
};