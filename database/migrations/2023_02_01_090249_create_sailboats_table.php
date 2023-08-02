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
        Schema::create('sailboats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('displacement')->nullable();
            $table->string('status');
            $table->string('loa')->nullable();
            $table->string('motor')->nullable();
            $table->string('battery_brand')->nullable();
            $table->string('battery_type')->nullable();
            $table->string('solar_panel')->nullable();
            $table->string('wind_generator')->nullable();
            $table->string('genset')->nullable();
            $table->string('controller')->nullable();
            $table->string('sailing_type')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('sailboats');
    }
};
