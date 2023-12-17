<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PhongSeeder extends Seeder
{
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở collection đó
        DB::collection('phongs')->delete();

        // 2. Thêm mới phòng bằng lệnh create
        DB::collection('phongs')->insert([
            [
                'ten_phong' => "Phòng 1",
                'tinh_trang' => 1,
                'hang_doc' => 5,
                'hang_ngang' => 10,
            ],
            [
                'ten_phong' => "Phòng 2",
                'tinh_trang' => 0,
                'hang_doc' => 4,
                'hang_ngang' => 8,
            ],
            // Add more phong data as needed
        ]);
    }
}
