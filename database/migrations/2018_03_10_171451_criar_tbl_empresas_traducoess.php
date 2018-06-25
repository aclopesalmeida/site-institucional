<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTblEmpresasTraducoess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_traducoes', function(Blueprint $table){
            $table->tinyInteger('empresa_id', false, true);
            $table->string('idioma_codigo');
            $table->text('descricao');
            $table->primary(['empresa_id', 'idioma_codigo']);
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
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
