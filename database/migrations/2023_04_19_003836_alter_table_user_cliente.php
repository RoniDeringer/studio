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
        Schema::table('users', function (Blueprint $table) {
            $table->date('data_nascimento')->change();
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
        Schema::table('cliente', function (Blueprint $table) {
            $table->date('ultimo_atendimento')->nullable();
        });
        
    }
        // php artisan migrate --path=/database/migrations/2023_04_19_003836_alter_table_user_cliente.php

        //   php artisan migrate:rollback --step=1 --path=/database/migrations/2023_04_19_003836_alter_table_user_cliente.php


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
