<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folio');
            $table->integer('cliente_id');
            $table->decimal('monto',11,2);
            $table->decimal('anticipo',11,2);
            $table->decimal('saldo',11,2);
            $table->integer('vendedor_id');
            $table->string('status');
            $table->decimal('impuestos',11,2);
            $table->string('comentarios');
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
        Schema::drop('notas');
    }
}
