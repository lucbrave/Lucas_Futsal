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
        Schema::dropIfExists('goals');
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('team');
            $table->foreign('team')
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
            $table->unsignedbiginteger('matche');
            $table->foreign('matche')
                ->references('id')
                ->on('matches')
                ->onDelete('cascade');
            $table->unsignedbiginteger('player');
            $table->foreign('player')
                ->references('id')
                ->on('players')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
