<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corpuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corpora_id')->unsigned();
            $table->foreign('corpora_id')->references('id')->on('corporas')->onDelete('cascade');;
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
        Schema::dropIfExists('corpuses');
    }
}
