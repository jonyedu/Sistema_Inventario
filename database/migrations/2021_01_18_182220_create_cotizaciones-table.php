<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_proovedor', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('descripcion')->nullable();
            $table->string('file_cotizacion')->nullable();
            $table->string('estado')->default('Activa');
            $table->unsignedInteger('proovedor_id')->nullable();
            $table->foreign('proovedor_id')->references('id')->on('proovedores');
            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->float('precio', 8, 2);
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
        Schema::dropIfExists('asset_proovedor');
    }
}
