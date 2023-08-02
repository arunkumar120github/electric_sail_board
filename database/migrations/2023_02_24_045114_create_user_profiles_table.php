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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('phone');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('sailing_experience');
            $table->string('preferred_type');
            $table->string('household_income');
            $table->boolean('is_sailboat_owner');
            $table->string('vendor_id')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
};
