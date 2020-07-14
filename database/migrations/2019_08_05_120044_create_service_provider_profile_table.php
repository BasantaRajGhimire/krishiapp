<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('service_provider_id');
            $table->string('type');
            $table->text('name');
            $table->unsignedInteger('number');
            $table->timestamps();

            $table->foreign('service_provider_id')->references('id')->on('service_provider_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_profile');
    }
}
