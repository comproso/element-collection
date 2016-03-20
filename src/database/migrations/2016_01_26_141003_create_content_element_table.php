<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_elements', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('position')->unsigned();
            $table->string('type', 20);
            $table->string('html')->nullable()->default(null);
            $table->string('html_tag')->nullable()->default(null);
            $table->enum('wrapper_type', ['begin', 'end'])->nullable()->default(null);
            $table->string('label')->nullable()->default(null);
            $table->string('form_name');
            $table->string('form_input_type', 20)->nullable()->default(null);
            $table->text('form_params')->nullable()->default(null);
            $table->text('form_options')->nullable()->default(null);
            $table->string('form_validation')->default('string');
            $table->string('cssid')->nullable();
            $table->string('cssclass')->nullable();
            $table->string('template')->nullable();

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
        Schema::dropIfExists('content_elements');
    }
}
