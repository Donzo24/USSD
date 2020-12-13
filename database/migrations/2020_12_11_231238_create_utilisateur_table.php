<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->integer('id_utilisateur')->autoIncrement();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('telephone')->unique();

            $table->string('temp_variable')->nullable();

            $table->string('session_id')->nullable();
            $table->string('session_level')->nullable();
            $table->string('langue')->nullable();

            $table->string('password')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateur');
    }
}
