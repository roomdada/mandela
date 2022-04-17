<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
            ->references('id')
            ->on('articles')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->integer('quantite');
            $table->integer('prix_total');
            $table->date('date_commande');
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
        Schema::dropIfExists('commandes');
    }
}
