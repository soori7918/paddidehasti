<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('fa')->nullable();
            $table->string('fa_name')->nullable();
        });
        // Schema::create('admin_module_admin_role', function (Blueprint $table) {
        //     $table->unsignedBigInteger('admin_module_id')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_modules');
    }
}
