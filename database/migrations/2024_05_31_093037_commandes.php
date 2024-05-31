<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->float('price', 8, 2); // 8 is the total digits, 2 is the number of digits after the decimal point
            $table->unsignedBigInteger('id_codepromo');
            $table->unsignedBigInteger('id_user');

            // Foreign key constraints
            $table->foreign('id_codepromo')->references('id')->on('promo_codes')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_codepromo')->nullable()->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};
