<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStructuralServiceFieldsToClientPostServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_post_services', function (Blueprint $table) {
            $table->string('land_area')->nullable();
            $table->unsignedInteger('no_of_storey')->nullable();
            $table->string('floor_space')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_post_services', function (Blueprint $table) {
            if (Schema::hasColumn('client_post_services', 'land_area')) {
                $table->dropColumn('land_area');
            }
            if (Schema::hasColumn('client_post_services', 'no_of_storey')) {
                $table->dropColumn('no_of_storey');
            }
            if (Schema::hasColumn('client_post_services', 'floor_space')) {
                $table->dropColumn('floor_space');
            }
        });
    }
}
