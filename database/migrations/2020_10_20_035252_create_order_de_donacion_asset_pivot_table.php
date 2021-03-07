<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeDonacionAssetPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_orden__donacion', function (Blueprint $table) {
            $table->unsignedInteger('orden__donacion_id');
            $table->foreign('orden__donacion_id', 'orden_de_donacion_id_fk_1230342')->references('id')->on('ordenes_de_donacion')->onDelete('cascade');
            $table->unsignedInteger('asset_id');
            $table->foreign('asset_id', 'asset_id_fk_1230342')->references('id')->on('assets')->onDelete('cascade');
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_orden_donacion');
    }
}
