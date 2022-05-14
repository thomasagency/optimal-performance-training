<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::dropIfExists('time_tables');
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('lang_id');
             $table->integer('time_categories_id');        
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->json('image')->nullable();
            $table->string('date');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('trainer')->nullable();
            $table->integer('color');
            $table->longText('content')->nullable();
            $table->longText('meta_tags')->nullable();
            $table->longText('meta_description')->nullable();
            $table->enum('status',[0,1])->default(1);
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
        Schema::dropIfExists('time_tables');
    }
}
