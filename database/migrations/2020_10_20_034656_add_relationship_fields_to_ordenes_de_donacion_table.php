<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdenesDeDonacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordenes_de_donacion', function (Blueprint $table) {
            $table->unsignedInteger('donador_id')->nullable();
            $table->foreign('donador_id')->references('id')->on('donadores');
        });
    }
}
