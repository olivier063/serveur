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
        Schema::create('annonces', function (Blueprint $table) {

            // le nullable rend le champs facultatif
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->string('auteur')->nullable();
            $table->string('description');
            $table->float('prix')->default(10)->nullable();
            $table->string('titre');
            $table->string('image');
            $table->integer('nombre de like')->default(0)->nullable();
            $table->boolean('vendu/non vendu')->default(0)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonces');
    }
};
