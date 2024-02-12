<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('matches');
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('ini_date');
            $table->dateTime('end_date');
            $table->string('score_team1');
            $table->string('score_team2');
            $table->unsignedbiginteger('team_1');
            $table->foreign('team_1')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
            $table->unsignedbiginteger('team_2');
            $table->foreign('team_2')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
