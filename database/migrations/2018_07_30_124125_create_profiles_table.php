<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number', 50);
            $table->string('agent', 100)->nullable();
            $table->string('consumer_name', 100)->nullable();
            $table->string('consumer_age', 50)->nullable();
            $table->string('consumer_gender', 50)->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('police_station_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->string('alternative_phone_number', 50)->nullable();
            $table->string('profession', 100)->nullable();
            $table->string('sec', 50)->nullable();
            $table->string('number_of_child', 50)->nullable();
            $table->string('total_family_member', 50)->nullable();
            $table->date('child1_DOB')->nullable();
            $table->date('child2_DOB')->nullable();
            $table->date('child3_DOB')->nullable();
            $table->string('prefered_brand')->nullable();
            $table->integer('brand_id')->unsigned()->nullable();
            $table->string('product', 100)->nullable();
            $table->string('activity_campaign_name', 150)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('profiles');
    }
}
