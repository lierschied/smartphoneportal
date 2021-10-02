<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmartphonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->string('model', 35)->nullable();
            $table->string('network_technology', 35)->nullable();
            $table->string('launch_status', 48)->nullable();
            $table->string('body_dimensions', 63)->nullable();
            $table->string('body_weight', 48)->nullable();
            $table->string('display_type', 64)->nullable();
            $table->string('display_size', 65)->nullable();
            $table->string('display_resolution', 124)->nullable();
            $table->string('display', 317)->nullable();
            $table->string('sound_35_mm_jack', 30)->nullable();
            $table->string('comms_wlan', 127)->nullable();
            $table->string('comms_bluetooth', 50)->nullable();
            $table->string('comms_gps', 80)->nullable();
            $table->string('comms_usb', 72)->nullable();
            $table->string('features_sensors', 123)->nullable();
            $table->string('features', 312)->nullable();
            $table->string('misc_colors', 229)->nullable();
            $table->string('platform_os', 142)->nullable();
            $table->string('platform_chipset', 120)->nullable();
            $table->string('platform_cpu', 183)->nullable();
            $table->string('platform_gpu', 62)->nullable();
            $table->string('memory_internal', 96)->nullable();
            $table->string('main_camera_single', 132)->nullable();
            $table->string('main_camera_video', 101)->nullable();
            $table->string('body_build', 153)->nullable();
            $table->string('comms_nfc', 62)->nullable();
            $table->string('battery_charging', 165)->nullable();
            $table->string('battery', 113)->nullable();
            $table->string('battery_talk_time', 53)->nullable();
            $table->string('battery_stand_by', 48)->nullable();

            $table->enum('category', ['Beginner', 'Normal', 'HighEnd']);
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('smartphones');
    }
}
