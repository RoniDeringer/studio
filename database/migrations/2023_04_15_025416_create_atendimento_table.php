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
        Schema::create('atendimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('cliente');
            $table->foreignId('id_funcionario')->nullable()->constrained('funcionario');
            $table->foreignId('id_terceirizado')->nullable()->constrained('terceirizado');
            $table->date('data');
            $table->decimal('valor',8,2);
            $table->string('servico');
            $table->string('observacao', 500)->nullable();
            $table->timestamps();
        });
    }

    //php artisan migrate:rollback --step=1 --path=/database/migrations/2023_04_12_012416_create_atendimento_table.php


    // php artisan migrate --path=/database/migrations/2023_04_12_012416_create_atendimento_table.php


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimento');
    }
};
