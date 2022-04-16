<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [];
        $a = 2;
        for ($i = 2; $i <= 10; $i++) {

            $employee[] = [
                'user_id' => $a++,
                'first_name' => 'first_name_'.$i,
                'middle_name' => 'middle_name_'.$i,
                'surname' => 'surname_'.$i,
                'birthday' => Carbon::today()->subDays(rand(0, 365)),
                'residancy_status' => 'residancy_status_'.$i,
                'residental_address' => 'residental_address_'.$i,
                'home_tel' => uniqid(),
                'mobile_tel' => uniqid(),
                'email' => 'employee_'.$i.'@gmail.com',
                'postal_address' => 'postal_address_'.$i,
                'cont1_relationship' => 'cont1_relationship_'.$i,
                'cont1_home_tel' => uniqid(),
                'cont1_mobile_tel' => uniqid(),
                'cont1_address' => 'cont1_address_'.$i,
                'cont2_relationship' => 'cont2_relationship_'.$i,
                'cont2_home_tel' => uniqid(),
                'cont2_mobile_tel' => uniqid(),
                'cont2_address' => 'cont2_address_'.$i,
                'bank_name' => 'bank_name_'.$i,
                'branch' => 'bank_name_'.$i,
                'account_name' => 'account_name_'.$i,
                'bsb' => uniqid(),
                'account_num' => uniqid(),
                'company_abn' => uniqid(),
                'threshold' => true,
                'super_fund_name' => 'super_fund_name_'.$i,
                'bsb_super_fund' => 'bsb_super_fund_'.$i,
                'fund_account_num' => uniqid(),
                'bpay_biller_code' => uniqid(),
                'reference_num' => uniqid(),
                'start_date' => now(),
                'client' => 'client_'.$i,
                'position' => 'position_'.$i,
                'location' => 'location_'.$i,
                'notes' => 'notes_'.uniqid(),
            ];

        }

        DB::table('employee_pro_files')->insert($employee);
    }
}
