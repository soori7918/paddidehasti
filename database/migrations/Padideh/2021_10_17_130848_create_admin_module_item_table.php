<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModuleItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_module_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('fa-name')->nullable();
            $table->integer('clickable_type')->nullable()->default(0);
            $table->integer('admin_module_id')->nullable()->default(0);
            $table->integer('parent_id')->nullable()->default(0);
            $table->integer('active_in_project')->nullable()->default(0);
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
        Schema::dropIfExists('admin_module_items');
    }
}
