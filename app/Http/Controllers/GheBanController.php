<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailSuccess;
use App\Jobs\SendMailJob;
use App\Mail\SendMailMuaVe;
use App\Models\GheBan;
use App\Models\Phim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use MongoDB\BSON\ObjectID;

class GheBanController extends Controller
{
    public function huyVeAuto()
    {
        $now = Carbon::now()->subMinutes(2);
        // dd($now);
        GheBan::where('trang_thai', 1)
              ->where('id_bill_ngan_hang', 0)
              ->where('updated_at', '<=', $now->toDateTimeString())
              ->update([
                'trang_thai' => 0,
                'id_khach_hang' => null,
                'ma_giao_dich'  => null,
              ]);
    }

    public function doiTrangThaiGheBan(Request $request)
    {
        $ghe_ban = GheBan::where('_id', new ObjectID($request->_id))->first();
        $ghe_ban->co_the_ban = !$ghe_ban->co_the_ban;
        $ghe_ban->save();
    }

    public function getData($id_lich)
    {
        $data = GheBan::where('id_lich', new ObjectID($id_lich))->get();

        return response()->json([
            'data'  => $data,
        ]);
    }
}
