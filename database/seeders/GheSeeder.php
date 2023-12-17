<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Ghe;

class GheSeeder extends Seeder
{
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở collection đó
        DB::collection('ghes')->delete();

        $phongs = DB::collection('phongs')->get();

        foreach ($phongs as $phong) {
            for ($dong = 1; $dong <= $phong['hang_ngang']; $dong++) {
                $chu = chr($dong + 64);
                for ($cot = 1; $cot <= $phong['hang_doc']; $cot++) {
                    $ten_ghe = $chu . $cot;
                    Ghe::create([
                        'ten_ghe'       => $ten_ghe,
                        'tinh_trang'    => 1,
                        'id_phong'      => $phong['_id'],
                    ]);
                }
            }
        }
    }
}
