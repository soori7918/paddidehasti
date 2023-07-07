<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waste_id');
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->string('weight')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('waste_orderhead_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('waste_id')->references('id')->on('wastes');
            $table->foreign('waste_orderhead_id')->references('id')->on('waste_orderheads');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waste_orders');
    }
}
