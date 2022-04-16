<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies_crm', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->boolean('Expired');
            $table->string('Summary');
            $table->text('Description');
            $table->json('BulletPoints');
            $table->json('Salary');
            $table->json('Classifications');
            $table->json('Apply');
            $table->string('Reference');
            $table->dateTime('DatePosted');
            $table->dateTime('DateUpdated');
            $table->string('Recruiter')->nullable();

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
        Schema::dropIfExists('vacancies_crm');
    }
};
