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
        Schema::create('card_version_centers', function (Blueprint $table) {
            $table->id();
            $table->string('na_center',50);
            $table->foreignId('province_id')->constrained('provinces')->cascadeOnDelete();
            $table->foreignId('directorate_id')->constrained('directorates')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_version_centers');
    }
};
