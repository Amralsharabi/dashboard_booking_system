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
        Schema::create('data_witnesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('req_id');
            $table->foreignId('request_type_id')->constrained('ty_documents')->cascadeOnDelete();
            $table->string('foreNa_witn', 50);
            $table->string('secondNa_witn', 50);
            $table->string('thirdNa_witn', 50);
            $table->string('tit_witn', 50);
            $table->string('work_head_witn', 50);
            $table->foreignId('jihat_work_id')->constrained('jihat_works')->cascadeOnDelete();
            $table->string('phone_witn', 20);
            $table->foreignId('ty_document_witn_id')->constrained('ty_documents')->cascadeOnDelete();
            $table->string('card_id',12);
            $table->foreignId('card_version_center_id')->constrained('card_version_centers')->cascadeOnDelete();
            $table->date('date_card_issuance');
            $table->string('address_witn', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_witnesses');
    }
};
