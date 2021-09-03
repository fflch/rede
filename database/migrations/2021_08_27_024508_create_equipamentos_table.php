<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('hostname')->unique();
            $table->string('model');
            $table->string('ip');
            $table->string('poe_type');
            $table->string('local');
            $table->string('position');

            $table->string('uplink_extra_ports')->nullable();
            $table->string('rep_ports')->nullable();
            $table->string('printer_ports')->nullable();
            $table->string('ignore_ports')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamentos');
    }
}
