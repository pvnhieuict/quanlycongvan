<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentouts', function (Blueprint $table) {
            $table->id();
            $table->string('label_number');
            $table->string('title');
            $table->unsignedBigInteger('type_id');
            $table->boolean('secret');
            $table->integer('status');
            $table->string('pathpdf');
            $table->string('signature');//nguoi ky
            $table->date('signature_date');
            $table->date('out_date');
            $table->date('store_date');
            $table->string('detail');
            $table->unsignedBigInteger('store_id');
            $table->integer('copy_number');//so ban
            $table->string('to_place');
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
        Schema::dropIfExists('documentouts');
    }
}
