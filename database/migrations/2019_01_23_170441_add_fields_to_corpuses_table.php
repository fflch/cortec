<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCorpusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corpuses', function (Blueprint $table) {
            $table->string('tipologia');
            $table->string('compilador');
            $table->integer('ano');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corpuses', function (Blueprint $table) {
            $table->dropColumn('tipologia');
            $table->dropColumn('compilador');
            $table->dropColumn('ano');
        });
    }
}
