<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->string('phone_number', 50);
            $table->integer('brand_id')->unsigned()->nullable();
            $table->string('product', 100)->nullable();
            $table->string('competition_brand_usage', 150)->nullable();
            $table->string('activity_campaign_name', 150)->nullable();
            $table->string('source_of_knowing', 50)->nullable();
            $table->string('ccid', 50)->nullable();
            $table->string('sales_force', 50)->nullable();
            $table->string('consumer_satisfaction_index', 50)->nullable();
            $table->string('interested_in_crm', 50)->nullable();
            $table->string('reasons_of_call', 50)->nullable();
            $table->string('call_category', 50)->nullable();
            $table->string('verbatim')->nullable();
            $table->string('quiz_question', 150)->nullable();
            $table->string('quiz_ans_given', 100)->nullable();
            $table->string('quiz_ans_status', 50)->nullable();
            $table->string('supervisor_name', 100)->nullable();
            $table->string('husband_name', 100)->nullable();
            $table->string('product_sold', 50)->nullable();
            $table->string('supervisor_visited', 50)->nullable();
            $table->string('permission_contact', 50)->nullable();
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
        Schema::drop('crms');
    }
}
