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
        Schema::create('valid_lokasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->foreignId('distributor_id')->constrained('distributors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        // banyak kelurahan satu distributor
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valid_lokasis');
    }
};
