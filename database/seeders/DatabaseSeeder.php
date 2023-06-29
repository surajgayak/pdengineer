<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\GenderType;
use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'fname' => 'admin',
            'lname' => 'panel',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123$'),
            'user_type' => UserType::ADMIN,
            'position' => 'Developer',
            'phone_no' => '123456789',
            'gender' => GenderType::MALE
        ]);
        // for ($i = 1; $i < 30; $i++) :
        //     DB::table('users')->insert([
        //         'fname' => 'user',
        //         'lname' => mt_rand(3, 40),
        //         'email' => 'user' . mt_rand(40, 100) . '@gmail.com',
        //         'password' => bcrypt('pdeuser@123'),
        //         'user_type' => UserType::USER,
        //         'position' => 'Developer',
        //         'phone_no' => '123456789',
        //         'gender' => GenderType::MALE
        //     ]);
        // endfor;
    }
}
