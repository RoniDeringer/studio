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
        Schema::table('terceirizado', function (Blueprint $table) {
            $table->string('foto', 1000)->nullable();
            $table->renameColumn('servico', 'funcao');
        });
    }
            //  php artisan migrate:rollback --step=1 --path=/database/migrations/2023_04_21_130033_alter_terceirizado.php

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
