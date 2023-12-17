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
        DB::collection('configs')->delete();

        $phimIds = DB::collection('phims')->pluck('_id')->toArray();

        $configData = [
            'bg_homepage' => "/assets_client/img/banner/s_slider_bg.jpg",
            'id_phim' => isset($phimIds[0]) ? $phimIds[0] : null,
            'phim_2' => isset($phimIds[1]) ? $phimIds[1] : null,
            'phim_3' => isset($phimIds[2]) ? $phimIds[2] : null,
        ];

        // Insert the example data into 'configs' collection
        DB::collection('configs')->insert([$configData]);
    }
}
