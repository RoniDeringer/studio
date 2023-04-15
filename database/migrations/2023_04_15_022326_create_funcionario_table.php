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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users');
            $table->string('cargo');
            $table->string('foto', 1000)->nullable();
            $table->timestamps();
        });
    }

    
    //php artisan migrate:rollback --step=1 --path=/database/migrations/2023_04_15_022326_create_funcionario_table.php


    // php artisan migrate --path=/database/migrations/2023_04_15_022326_create_funcionario_table.php


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
};
