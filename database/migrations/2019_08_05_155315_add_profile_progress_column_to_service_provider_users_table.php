<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileProgressColumnToServiceProviderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_provider_users', function (Blueprint $table) {
            $table->integer('profile_progress')->unsigned()->default(40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('service_provider_users', 'profile_progress')) {
            Schema::table('service_provider_users', function (Blueprint $table) {

                $table->dropColumn('profile_progress');
            });
        }
    }
}
