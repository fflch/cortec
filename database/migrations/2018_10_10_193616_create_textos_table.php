<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corpus_id')->unsigned();
            $table->foreign('corpus_id')->references('id')->on('corpuses')->onDelete('cascade');;
            $table->char('idioma', 5);
            $table->longText('conteudo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('texts');
    }
}
