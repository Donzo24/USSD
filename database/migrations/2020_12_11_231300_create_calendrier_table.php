<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendrier', function (Blueprint $table) {
            $table->integer('id_calendrier')->autoIncrement();
            $table->date('date_derniere_regle');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('duree_cycle');
            $table->integer('phase_lutuale');

            $table->integer('id_utilisateur');

            $table->foreign('id_utilisateur')
            ->references('id_utilisateur')->on('utilisateur')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendrier');
    }
}
