<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\GheBan;
use App\Models\LichChieu;
use MongoDB\BSON\ObjectID;

class GheBanSeeder extends Seeder
{
    public function run()
    {
        // 1. Khi seeder thì ta muốn xóa toàn bộ dữ liệu ở collection đó
        DB::collection('ghe_bans')->delete();

        $lichChieus = LichChieu::all();

        foreach ($lichChieus as $lichChieu) {
            $phong = DB::collection('phongs')->where('_id', $lichChieu->id_phong)->first();

            if ($phong) {
                $tatCaGhe = DB::collection('ghes')->where('id_phong', $phong['_id'])->get();

                foreach ($tatCaGhe as $value) {
                    GheBan::create([
                        'id_lich' => new ObjectID($lichChieu->_id),
                        'ten_ghe' => $value['ten_ghe'],
                    ]);
                }
            }
        }
    }
}
