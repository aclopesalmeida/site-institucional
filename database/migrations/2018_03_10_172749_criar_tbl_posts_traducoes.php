<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTblPostsTraducoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_traducoes', function(Blueprint $table) {
            $table->string('idioma_codigo');
            $table->integer('post_id', false, true);
            $table->string('titulo');
            $table->text('corpo');
            $table->primary(['idioma_codigo', 'post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('idioma_codigo')->references('codigo')->on('idiomas')->onDelete('cascade');
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
        //
    }
}
