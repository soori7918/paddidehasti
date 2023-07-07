<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile');
            $table->string('family')->nullable();
            $table->string('car_id')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('car_pelak',100)->nullable();
            $table->string('car_name',100)->nullable();
            $table->string('shaba_number',26)->nullable();
            $table->string('card_number',20)->nullable();
            $table->string('image',100)->nullable();
            $table->string('cm_image',100)->nullable();
            $table->string('certificate_image',100)->nullable();
            $table->string('car_cart_image',100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('drivers');
    }
}
