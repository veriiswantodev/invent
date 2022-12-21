<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'company' => 'SMK Antartika 1 Sidoarjo',
            'logo_1' => '/images/logo.png',
            'logo_2' => '/images/logo.png',
            'favicon' => '/images/logo.png'
        ]);
    }
}
