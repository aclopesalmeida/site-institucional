<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTblServicosTraducoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_traducoes', function(Blueprint $table){
            $table->tinyInteger('servico_id', false, true);
            $table->string('idioma_codigo');
            $table->string('designacao', 70);
            $table->text('descricao');
            $table->primary(['servico_id', 'idioma_codigo']);
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            $table->foreign('idioma_codigo')->references('codigo')->on('idiomas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
