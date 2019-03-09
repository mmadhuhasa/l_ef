<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LrHitoryMigration2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('lr_history', function(Blueprint $table){
          
           $table->boolean('lr_licence_details_is_active')->default(0)->change();
           $table->boolean('lr_licence_details_is_delete')->default(0)->change();
           
           $table->boolean('lr_licence_details_is_active2')->default(0)->change();
           $table->boolean('lr_licence_details_is_delete2')->default(0)->change();
           
           $table->boolean('is_active')->default(0)->change();
           $table->boolean('is_delete')->default(0)->change();
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
