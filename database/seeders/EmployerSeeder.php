<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employer = [];

        for ($i = 1; $i <= 10; $i++) {
            $name = 'employer_'.$i;
            $email = 'employer_'.$i.'@gmail.com';

            $employer[] = [
                'name' => $name,
                'email' => $email,
                'role' => 'employer',
                'email_verified_at' => now()->toDateTimeString(),
                'password' => Hash::make('12345678')
            ];

        }

        DB::table('users')->insert($employer);
    }
}
