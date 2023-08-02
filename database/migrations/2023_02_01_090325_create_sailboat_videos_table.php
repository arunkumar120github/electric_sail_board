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
        Schema::create('sailboat_videos', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->bigInteger('sailboat_id');
            $table->string('vimeo_id')->nullable();
            $table->string('video_path');
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
        Schema::dropIfExists('sailboat_videos');
    }
};
