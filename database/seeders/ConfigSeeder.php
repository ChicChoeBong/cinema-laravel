<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();

        // Reset id về lại 1
        DB::table('configs')->truncate();

        DB::table('configs')->insert([
            [
                'bg_homepage'     => "/assets_client/img/banner/s_slider_bg.jpg",
                'id_phim'         => "2",
                'phim_2'          => "3",
                'phim_3'          => "4",
            ],
        ]);
    }
}
