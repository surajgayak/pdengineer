<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'logo' => 'PD  Enginnering',
            'email' => 'pd@gmail.com',
            'phone_no' => '987654321',
            'address' => '654 Shadow Brook St. Palatine, IL 60067',
            'meta_title' => 'This is meta title test',
            'meta_keywords' => 'This is meta keywords test',
            'meta_description' => 'This is meta description test'
        ]);
    }
}