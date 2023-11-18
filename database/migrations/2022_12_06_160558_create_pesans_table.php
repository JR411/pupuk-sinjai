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
        Schema::create('pesans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('petani_id')->constrained('petanis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('distributor_id')->nullable()->constrained('distributors')->onUpdate('cascade')->onDelete('cascade');
            $table->string('alamat')->nullable();
            $table->double('luas')->unsigned()->nullable();
            $table->string('lahan')->nullable();
            $table->text('lokasi')->nullable();
            $table->longText('ket')->nullable();
            $table->string('status')->nullable();
            $table->boolean('bayar')->default(false);
            $table->boolean('kirim')->default(false);
            $table->boolean('selesai')->default(false);
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
        Schema::dropIfExists('pesans');
    }
};
