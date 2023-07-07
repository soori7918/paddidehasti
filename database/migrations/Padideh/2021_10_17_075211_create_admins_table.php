<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(NULL);
            $table->string('family')->nullable()->default(NULL);
            $table->string('email')->unique()->nullable()->default(NULL);
            $table->string('mobile')->unique()->required();
            $table->string('password')->required();
            $table->text('description')->nullable()->default(NULL);
            $table->string('region')->nullable()->default(NULL);
            $table->boolean('access_status')->nullable()->default(NULL);
            $table->string('remember_token')->nullable()->default(NULL);
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
        Schema::dropIfExists('admins');
    }
}
