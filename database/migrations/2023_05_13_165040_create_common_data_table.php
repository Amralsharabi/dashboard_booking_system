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
        Schema::create('common_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('id_card', 11)->nullable();
            $table->string('req_fore_na', 30);
            $table->string('req_second_na', 30);
            $table->string('req_third_na', 30);
            $table->string('req_tit', 30);
            $table->foreignId('nationality_req_id')->constrained('countrie_nationalits')->cascadeOnDelete();
            $table->string('father_fore_na', 30);
            $table->string('father_second_na', 30);
            $table->string('father_third_na', 30);
            $table->string('father_tit', 30);
            $table->foreignId('nationality_father_id')->constrained('countrie_nationalits')->cascadeOnDelete();
            $table->string('mother_fore_na', 30);
            $table->string('mother_second_na', 30);
            $table->string('mother_third_na', 30);
            $table->string('mother_tit', 30);
            $table->foreignId('nationality_mother_id')->constrained('countrie_nationalits')->cascadeOnDelete();
            $table->integer('gender');
            $table->date('date_pirth_ad');
            $table->string('date_pirth_he', 30);
            $table->foreignId('countrie_birth_id')->constrained('countrie_nationalits')->cascadeOnDelete();
            $table->foreignId('province_birth_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('directorate_pirth_id')->constrained('directorates')->cascadeOnDelete();
            $table->string('village_parth', 30);
            $table->foreignId('religions_id')->constrained('religions')->cascadeOnDelete();
            $table->foreignId('social_statu_id')->constrained('social_status')->cascadeOnDelete();
            $table->integer('learning_condition');
            $table->foreignId('certificate_id')->constrained('certificates')->cascadeOnDelete();
            $table->foreignId('specialtie_id')->constrained('specialties')->cascadeOnDelete();
            $table->foreignId('profession_id')->constrained('professions')->cascadeOnDelete();
            $table->foreignId('jihat_work_id')->constrained('jihat_works')->cascadeOnDelete();
            $table->foreignId('countrie_accom_id')->constrained('countrie_nationalits')->cascadeOnDelete();
            $table->foreignId('province_accom_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('directorate_accom_id')->constrained('directorates')->cascadeOnDelete();
            $table->string('village_accom', 30);
            $table->string('neigh_accom', 30);
            $table->string('street_accom', 30)->nullable();
            $table->string('house_accom', 30)->nullable();
            $table->string('num_phone', 20);
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
        Schema::dropIfExists('common_data');
    }
};
