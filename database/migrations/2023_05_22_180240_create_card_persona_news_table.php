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
        Schema::create('card_persona_news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('common_data_id')->constrained('common_data')->cascadeOnDelete();
            $table->foreignId('province_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('directorate_id')->constrained('directorates')->cascadeOnDelete();
            $table->foreignId('center_id')->constrained('card_version_centers')->cascadeOnDelete();
            $table->foreignId('blood_type_id')->constrained('blood_types')->cascadeOnDelete();
            $table->foreignId('request_statu_id')->constrained('request_status')->cascadeOnDelete();
            $table->date('time_attendees')->nullable();
            $table->string('time_attendees_hijri')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('card_persona_news');
    }
};
