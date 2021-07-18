<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->tinyInteger( 'isFullDuration' )->default(1);
            $table->string('fullDuration')->nullable();
            $table->string('perDuration')->nullable();
            $table->float('defaultMarks');
            $table->integer('maxExaminee')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('exams');
    }
}
