<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CompanyStatementsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('company_statements')->insert([
            [
                'title1' => 'Mission',
                'title1_main_content' => 'Our mission is to deliver innovative solutions...',
                'title1_sub_content' => 'Driving customer success through technology',
                'background_picture' => '75.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title1' => 'Motto',
                'title1_main_content' => 'Quality First, Always',
                'title1_sub_content' => 'Our guiding principle for every project',
                'background_picture' => '100.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title1' => 'Vision',
                'title1_main_content' => 'To be a global leader in tech innovation',
                'title1_sub_content' => 'Shaping the future of digital transformation',
                'background_picture' => '247.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
