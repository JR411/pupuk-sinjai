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
        Schema::create('distributors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('lokasi_dist');
            $table->string('alamat')->nullable();
            $table->string('cv');
            $table->string('sk');
            $table->string('no');
            $table->string('rek')->nullable();
            $table->string('bank')->nullable();
            $table->unsignedBigInteger('urea')->nullable();
            $table->unsignedBigInteger('za')->nullable();
            $table->unsignedBigInteger('npk')->nullable();
            $table->longText('ket')->nullable();
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
        Schema::dropIfExists('distributors');
    }
};
