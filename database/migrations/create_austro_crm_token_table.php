<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('austro_crm_token', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('access_token')->nullable();
            $table->string('unified_token')->nullable();
            $table->string('status')->nullable();
            $table->string('expiry_time', 20)->nullable();
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
        Schema::dropIfExists('austro_crm_token');
    }
};
