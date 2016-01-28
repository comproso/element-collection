<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHtmlElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('html_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20);
            $table->integer('group_by')->unsigned()->default(0);
            $table->string('headline')->nullable()->default(null);
            $table->string('hl_tag', 2)->nullable()->default(null);
            $table->text('html');
            $table->string('form_name');
            $table->string('form_input_type', 20)->nullable()->default(null);
            //$table->json('form_options')->nullable()->default(null);
            $table->string('cssid');
            $table->string('cssclass');

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
        Schema::dropIfExists('html_elements');
    }
}
