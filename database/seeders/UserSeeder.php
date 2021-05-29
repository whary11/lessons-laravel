<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Status;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert(
             [
                 [
                'name'           => 'Administrador',
                'email'          => 'adm@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
             ],
             [
                'name'           => 'Luis',
                'email'          => 'luis.raga@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
             ],
             [
                'name'           => 'Argon',
                'email'          => ' admin@argon.com',
                'password'       => bcrypt('secret'),
                'remember_token' => null,
            ]
            ]
        );
    }
}
