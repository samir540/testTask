<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [];

        for ($i = 1; $i <= 10; $i++) {
            $name = 'employee_'.$i;
            $email = 'employee_'.$i.'@gmail.com';

            $employee[] = [
                'name' => $name,
                'email' => $email,
                'role' => 'employee',
                'email_verified_at' => now()->toDateTimeString(),
                'password' => Hash::make('12345678')
            ];

        }

        DB::table('users')->insert($employee);
    }
}
