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
        Schema::create('employee_pro_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //personal details
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('surname');
            $table->date('birthday');
            $table->string('residancy_status');
            //contact details
            $table->string('residental_address');
            $table->string('home_tel');
            $table->string('mobile_tel');
            $table->string('email')->unique();
            $table->string('postal_address')->nullable();
            //emergeny contacts
            $table->string('cont1_relationship')->nullable();
            $table->string('cont1_home_tel')->nullable();
            $table->string('cont1_mobile_tel')->nullable();
            $table->string('cont1_address')->nullable();
            $table->string('cont2_relationship')->nullable();
            $table->string('cont2_home_tel')->nullable();
            $table->string('cont2_mobile_tel')->nullable();
            $table->string('cont2_address')->nullable();
            //financial details
            $table->string('bank_name');
            $table->string('branch');
            $table->string('account_name');
            $table->string('bsb');
            $table->string('account_num')->unique();
            $table->unsignedInteger('company_abn');
            $table->boolean('threshold')->default(false);
            $table->string('super_fund_name');
            $table->string('bsb_super_fund');
            $table->string('fund_account_num');
            $table->unsignedInteger('bpay_biller_code');
            $table->string('reference_num');
            //employment details
            $table->date('start_date');
            $table->string('client');
            $table->string('position');
            $table->string('location');
            $table->string('notes')->nullable();

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
        Schema::dropIfExists('employee_pro_files');
    }
};
