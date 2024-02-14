<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {

    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->unique(["nome", "numero_camisa","team_id"], 'nome_camisa_time');
        });
    }

    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
             $table->dropUnique('nome');
             $table->dropUnique('numero_camisa');
        });
    }
};
