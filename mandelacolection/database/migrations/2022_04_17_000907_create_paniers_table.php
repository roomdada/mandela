<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
            ->references('id')
            ->on('clients')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')
            ->references('id')
            ->on('commandes')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->string('lieu_commande');
            $table->date("updated_at");
            $table->date("created_at");
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paniers');
    }
}
