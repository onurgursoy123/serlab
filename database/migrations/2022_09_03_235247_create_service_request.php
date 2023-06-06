<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('task');
            $table->string('companyName');
            $table->string('department');
            $table->string('phone');
            $table->string('mail');
            $table->string('desiredService');
            $table->string('serviceDetail');
            $table->string('deviceType');
            $table->string('brand');
            $table->string('modelNo');
            $table->string('serialNo');
            $table->string('description');
            $table->string('address');
            $table->string('city');
            $table->integer('is_send')->default('0');
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
        Schema::dropIfExists('service_request');
    }
};
