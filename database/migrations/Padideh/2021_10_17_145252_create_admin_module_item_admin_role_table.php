<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminModuleItemAdminRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('admin_module_item_admin_role', function (Blueprint $table) {
        //     $table->unsignedBigInteger('admin_module_item_id')->nullable()->default(0);
        //     $table->unsignedBigInteger('admin_role_id')->nullable()->default(0);
        //     $table->unsignedBigInteger('add_permission');
        //     $table->unsignedBigInteger('edit_permission');
        //     $table->unsignedBigInteger('delete_permission');
        //     $table->unsignedBigInteger('view_permission');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_module_item_admin_role');
    }
}
