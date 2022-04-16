<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employer =[];
        $a = 12;
        for ($i = 1; $i <= 10; $i++){
            $employer[] = [
                'user_id' => $a++,
                'company_name' => 'name_employer_'.$i,
                'key_hiring' => 'key_hiring_'.$i,
                'phone_num_hiring' => uniqid(),
                'email_hiring' => 'email_hiring_'.$i.'@gmail.com',
                'key_accounts' => uniqid(),
                'phone_num_account' => uniqid(),
                'email' => 'email_'.$i.'@gmail.com',
                'add_inform' => 'add_inform_'.$i,
            ];
        }

        DB::table('employer_pro_files')->insert($employer);



    }
}
