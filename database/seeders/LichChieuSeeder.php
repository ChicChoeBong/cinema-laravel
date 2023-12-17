<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LichChieuSeeder extends Seeder
{
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở collection đó
        DB::collection('lich_chieus')->delete();

        // 2. Thêm mới lịch chiếu với references đến phongs và phims
        $phongIds = DB::collection('phongs')->pluck('_id')->toArray();
        $phimIds = DB::collection('phims')->pluck('_id')->toArray();

        $lichChieusData = [];

        foreach ($phongIds as $phongId) {
            foreach ($phimIds as $phimId) {
                $thoi_gian_chieu_chinh = rand(60, 300);
                $thoi_gian_quang_cao = rand(5, 15);
                $thoi_gian_bat_dau = now()->addDays(rand(1, 15))->addMinutes($thoi_gian_quang_cao);
                $thoi_gian_ket_thuc = $thoi_gian_bat_dau->addMinutes($thoi_gian_chieu_chinh);

                $lichChieusData[] = [
                    'id_phong' => $phongId,
                    'id_phim' => $phimId,
                    'thoi_gian_chieu_chinh' => $thoi_gian_chieu_chinh,
                    'thoi_gian_quang_cao' => $thoi_gian_quang_cao,
                    'thoi_gian_bat_dau' => $thoi_gian_bat_dau,
                    'thoi_gian_ket_thuc' => $thoi_gian_ket_thuc,
                ];
            }
        }

        DB::collection('lich_chieus')->insert($lichChieusData);
    }
}
