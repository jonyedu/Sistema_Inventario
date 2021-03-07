<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_de_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('descripcion')->nullable();
            $table->string('file_orden_compra')->nullable();
            $table->string('estado')->default('Generada');
            $table->unsignedInteger('proveedor_id')->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proovedores');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_de_compra');
    }
}
