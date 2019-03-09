<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColsUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
	Schema::table('users', function (Blueprint $table) {
	    $table->boolean('fpl')->default(0);
	    $table->boolean('fdtl')->default(0);
	    $table->boolean('navlog')->default(0);
	    $table->boolean('lnt')->default(0);
	    $table->boolean('notams')->default(0);
	    $table->boolean('weather')->default(0);
	    $table->boolean('lr')->default(0);
	    $table->boolean('runway')->default(0);
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
