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
        Schema::create('product_commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_command');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity', 11);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_command')->references('id')->on('commandes')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            
            // Clé primaire composite si nécessaire
            // $table->primary(['id_command', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_commande');
    }
};
