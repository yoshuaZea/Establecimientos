<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Job Zea',
            'email' => 'yoshua149@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Meli Zea',
            'email' => 'correo@correo.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
