<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LrHitoryMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lr_history', function(Blueprint $table){
           $table->increments('id');
           $table->integer('updated_by')->unsigned()->default(0);
           $table->integer('lr_licence_details_id')->unsigned()->default(0);
           
           $table->integer('lr_licence_details_user_id')->unsigned()->default(0);
	   $table->integer('lr_licence_details_license_type_id')->unsigned()->default(0);
           $table->string('lr_licence_details_from_date')->nullable();
	   $table->string('lr_licence_details_to_date')->nullable();
           $table->boolean('lr_licence_details_is_active')->default(0);
           $table->boolean('lr_licence_details_is_delete')->default(0);
           
           $table->integer('lr_licence_details_user_id2')->unsigned()->default(0);
	   $table->integer('lr_licence_details_license_type_id2')->unsigned()->default(0);
           $table->string('lr_licence_details_from_date2')->nullable();
	   $table->string('lr_licence_details_to_date2')->nullable();
           $table->boolean('lr_licence_details_is_active2')->default(0);
           $table->boolean('lr_licence_details_is_delete2')->default(0);
           
           $table->string('reason')->nullable();
           
           $table->boolean('is_active')->default(0);
           $table->boolean('is_delete')->default(0);
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
        //
    }
}
