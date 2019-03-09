<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CallsignStats extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('callsign_stats', function(Blueprint $table) {
            $table->integer('id', true);
            $table->string('aircraft_callsign', 244)->nullable();
            $table->tinyInteger('is_fpl')->default(0);
            $table->tinyInteger('is_fdtl')->default(0);
            $table->tinyInteger('is_navlog')->default(0);
            $table->tinyInteger('is_lnt')->default(0);
            $table->tinyInteger('is_notams')->default(0);
            $table->tinyInteger('is_weather')->default(0);
            $table->tinyInteger('is_lr')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
