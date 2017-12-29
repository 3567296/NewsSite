<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('access', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name')->unique()->comment('moderate | auth');

        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('access_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->tinyInteger('is_active')->default(0);
            $table->timestamps();

            $table->foreign('access_id')
                ->references('id')
                ->on('access')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('access');
    }
}
