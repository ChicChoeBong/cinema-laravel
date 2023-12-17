<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLichChieuRequest;
use App\Http\Requests\TaoLichChieuMotBuoiRequest;
use App\Http\Requests\XoaLichRequest;
use App\Http\Requests\UpdateLichRequest;
use App\Models\GheBan;
use App\Models\LichChieu;
use App\Models\Phong;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectID;

class LichChieuController extends Controller
{
    public function viewKhachHangDatVe($id_lich_chieu)
    {
        $lichChieu = LichChieu::where('_id', $id_lich_chieu)
            ->where('thoi_gian_ket_thuc', '>=', Carbon::now()->toDateTimeString())
            ->first();
        $user_login = Auth::guard('customer')->user()->_id ?? Auth::user()->_id;

        if ($lichChieu) {
            return view('client.dat_ve', compact('id_lich_chieu', 'user_login'));
        } else {
            toastr()->error("Lịch chiếu không tồn tại!");
            return redirect('/');
        }
    }

    public function showDataByIdLich($id_lich_chieu)
    {
        $data = GheBan::where('id_lich', $id_lich_chieu)->get();
        $phong = LichChieu::join('phongs', 'lich_chieus.id_phong', 'phongs._id')
            ->where('lich_chieus._id', $id_lich_chieu)
            ->first();

        return response()->json([
            'data'      => $data,
            'hang_doc'  => $phong->hang_doc,
            'hang_ngang' => $phong->hang_ngang,
        ]);
    }

    public function destroy(XoaLichRequest $request)
    {
        LichChieu::where('_id', $request->_id)->delete();

        GheBan::where('id_lich', $request->_id)->delete();
    }

    public function getData()
    {
        $data = LichChieu::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'phims',
                        'localField' => 'id_phim',
                        'foreignField' => '_id',
                        'as' => 'phim',
                    ],
                ],
                [
                    '$unwind' => '$phim',
                ],
                [
                    '$lookup' => [
                        'from' => 'phongs',
                        'localField' => 'id_phong',
                        'foreignField' => '_id',
                        'as' => 'phong',
                    ],
                ],
                [
                    '$unwind' => '$phong',
                ],
                [
                    '$project' => [
                        'ten_phim' => '$phim.ten_phim',
                        'ten_phong' => '$phong.ten_phong',
                        'thoi_gian_chieu_chinh' => '$thoi_gian_chieu_chinh',
                        'thoi_gian_quang_cao' => '$thoi_gian_quang_cao',
                        'thoi_gian_bat_dau' => '$thoi_gian_bat_dau',
                        'thoi_gian_ket_thuc' => '$thoi_gian_ket_thuc',
                        // Add other fields as needed
                    ],
                ],
                [
                    '$sort' => [
                        'thoi_gian_bat_dau' => 1,
                    ],
                ],
            ]);
        });

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function viewTaoMotBuoi()
    {
        return view('AdminLTE.Page.LichChieu.view_mot_buoi');
    }

    public function actionTaoMotBuoi(TaoLichChieuMotBuoiRequest $request)
    {
        $ngay_chieu = Carbon::createFromFormat("Y-m-d", $request->ngay_chieu);
        $ngay       = $ngay_chieu->day;
        $thang      = $ngay_chieu->month;
        $nam        = $ngay_chieu->year;
        $gio_bd     = Carbon::parse($request->gio_bat_dau);
        $gio_kt     = Carbon::parse($request->gio_ket_thuc);


        $now = Carbon::today();
        if ($ngay_chieu < $now) {
            return response()->json([
                'status'    => false,
                'message'   => 'Ngày chiếu phim phải lớn hơn hoặc bằng ngày hôm nay!'
            ]);
        }
        if ($gio_bd > $gio_kt) {
            return response()->json([
                'status'    => false,
                'message'   => 'Giờ kết thúc phải lớn hơn giờ bắt đầu!'
            ]);
        }
        $thoi_gian_bat_dau  = Carbon::create($nam, $thang, $ngay, $gio_bd->hour, $gio_bd->minute, 0);
        $thoi_gian_ket_thuc = Carbon::create($nam, $thang, $ngay, $gio_kt->hour, $gio_kt->minute, 0);

        // Th1 là giờ bắt đầu nằm giữa [thoi_gian_bat_dau và thoi_gian_ket_thuc]
        $gio_bat_dau  = $thoi_gian_bat_dau->toDateTimeString();
        $gio_ket_thuc = $thoi_gian_ket_thuc->toDateTimeString();


        $check_th1 = LichChieu::where('id_phong', $request->id_phong)
            ->where('thoi_gian_bat_dau', '<=', $gio_bat_dau)
            ->where('thoi_gian_ket_thuc', '>=', $gio_bat_dau)
            ->first();

        // Th2 là giờ kết thúc nằm giữa [thoi_gian_bat_dau và thoi_gian_ket_thuc]
        $check_th2 = LichChieu::where('id_phong', $request->id_phong)
            ->where('thoi_gian_bat_dau', '<=', $gio_ket_thuc)
            ->where('thoi_gian_ket_thuc', '>=', $gio_ket_thuc)
            ->first();
        // Th3 là giờ bắt đầu và giờ kết thúc bao trùm lên cả [thoi_gian_bat_dau và thoi_gian_ket_thuc]
        $check_th3 = LichChieu::where('id_phong', $request->id_phong)
            ->where('thoi_gian_bat_dau', '>=', $gio_bat_dau)
            ->where('thoi_gian_ket_thuc', '<=', $gio_ket_thuc)
            ->first();

        // $check = LichChieu::where('id_phong', $request->id_phong)
        //                   ->where(function($query) use ($gio_bat_dau, $gio_ket_thuc) {
        //                         $query->where(function($query_1) use ($gio_bat_dau) {
        //                             $query_1->where('thoi_gian_bat_dau', '<=', $gio_bat_dau)
        //                                     ->where('thoi_gian_ket_thuc', '>=', $gio_bat_dau);
        //                         })->orWhere(function($query_1) use ($gio_ket_thuc) {
        //                             $query_1->where('thoi_gian_bat_dau', '<=', $gio_ket_thuc)
        //                                     ->where('thoi_gian_ket_thuc', '>=', $gio_ket_thuc);
        //                         })->orWhere(function($query_1) use ($gio_bat_dau, $gio_ket_thuc) {
        //                             $query_1->where('thoi_gian_bat_dau', '>=', $gio_bat_dau)
        //                                     ->where('thoi_gian_ket_thuc', '<=', $gio_ket_thuc);
        //                         });
        //                   })
        //                   ->first();

        if ($check_th1 || $check_th2 || $check_th3) {
            return response()->json([
                'status'    => false,
                'message'   => 'Lịch chiếu đã bị trùng'
            ]);
        }

        $request['id_phong'] = new ObjectId($request['id_phong']);
        $request['id_phim'] = new ObjectId($request['id_phim']);

        $lich_chieu = LichChieu::create([
            'id_phong'                  => $request->id_phong,
            'id_phim'                   => $request->id_phim,
            'thoi_gian_chieu_chinh'     => $request->thoi_gian_chieu_chinh,
            'thoi_gian_quang_cao'       => $request->thoi_gian_quang_cao,
            'thoi_gian_bat_dau'         => $gio_bat_dau,
            'thoi_gian_ket_thuc'        => $gio_ket_thuc,
        ]);

        // Lấy tất các các ghế của phòng
        $tat_ca_ghe = Phong::where('phongs._id', $request->id_phong)
            ->join('ghes', 'ghes.id_phong', 'phongs._id')
            ->get();

        foreach ($tat_ca_ghe as $key => $value) {
            GheBan::create([
                'id_lich'   => $lich_chieu->_id,
                'ten_ghe'   => $value->ten_ghe,
            ]);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo lịch chiếu thành công'
        ]);
    }

    public function index()
    {
        return view('AdminLTE.Page.LichChieu.index');
    }

    public function store(CreateLichChieuRequest $request)
    {
        $ngay_bat_dau           = Carbon::createFromFormat("Y-m-d", $request->ngay_bat_dau)->startOfDay();
        $ngay_ket_thuc          = Carbon::createFromFormat("Y-m-d", $request->ngay_ket_thuc)->addDay()->startOfDay();

        $gio_bat_dau  = Carbon::parse($request->gio_bat_dau);
        $gio_ket_thuc = Carbon::parse($request->gio_ket_thuc);

        // Nếu ngày kết thúc < ngày bắt đầu => ngày kết thúc - ngày bắt đầu > 0
        while ($ngay_ket_thuc->diffInDays($ngay_bat_dau) > 0) {
            $thu_cua_ngay = $ngay_bat_dau->dayOfWeek;
            $ten          = "thu_" . $thu_cua_ngay;

            if (isset($request->$ten)) {
                // Tạo ra lịch chiếu
                $year   = $ngay_bat_dau->year;
                $month  = $ngay_bat_dau->month;
                $day    = $ngay_bat_dau->day;
                $hour_1 = $gio_bat_dau->hour;
                $mi_1   = $gio_bat_dau->minute;
                $hour_2 = $gio_ket_thuc->hour;
                $mi_2   = $gio_ket_thuc->minute;

                $thoi_gian_bat_dau  = Carbon::create($year, $month, $day, $hour_1, $mi_1, 0)->toDateTimeString();
                $thoi_gian_ket_thuc = Carbon::create($year, $month, $day, $hour_2, $mi_2, 0)->toDateTimeString();

                $request['id_phong'] = new ObjectId($request['id_phong']);
                $request['id_phim'] = new ObjectId($request['id_phim']);

                LichChieu::create([
                    'id_phong'                  => $request->id_phong,
                    'id_phim'                   => $request->id_phim,
                    'thoi_gian_chieu_chinh'     => $request->thoi_gian_chieu_chinh,
                    'thoi_gian_quang_cao'       => $request->thoi_gian_quang_cao,
                    'thoi_gian_bat_dau'         => $thoi_gian_bat_dau,
                    'thoi_gian_ket_thuc'        => $thoi_gian_ket_thuc,
                ]);
            }
            $ngay_bat_dau->addDay();
        }
    }

    public function viewThoiKhoaBieu()
    {
        return view('AdminLTE.Page.LichChieu.thoi_khoa_bieu');
    }

    public function dataThoiKhoaBieu()
    {
        $data = LichChieu::join('phims', 'lich_chieus.id_phim', 'phims._id')
            ->join('phongs', 'lich_chieus.id_phong', 'phongs._id')
            ->select(
                'phims.ten_phim',
                'phongs.ten_phong',
                'lich_chieus.thoi_gian_bat_dau as start',
                'lich_chieus.thoi_gian_ket_thuc as end'
            )
            ->get();
        foreach ($data as $key => $value) {
            $value->title = 'Tên phim: ' . $value->ten_phim . " - Phòng: " . $value->ten_phong;
        }
        return response()->json($data);
    }

    public function update(UpdateLichRequest $request)
    {
        // $ngay_bat_dau           = Carbon::createFromFormat("Y-m-d", $request->ngay_chieu)->startOfDay();
        // $ngay_ket_thuc          = Carbon::createFromFormat("Y-m-d", $request->ngay_chieu)->addDay()->startOfDay();

        // $gio_bat_dau  = Carbon::parse($request->gio_bat_dau);
        // $gio_ket_thuc = Carbon::parse($request->gio_ket_thuc);

        // // Nếu ngày kết thúc < ngày bắt đầu => ngày kết thúc - ngày bắt đầu > 0
        // while ($ngay_ket_thuc->diffInDays($ngay_bat_dau) > 0) {
        //     $thu_cua_ngay = $ngay_bat_dau->dayOfWeek;
        //     $ten          = "thu_" . $thu_cua_ngay;

        //     if (isset($request->$ten)) {
        //         // Tạo ra lịch chiếu
        //         $year   = $ngay_bat_dau->year;
        //         $month  = $ngay_bat_dau->month;
        //         $day    = $ngay_bat_dau->day;
        //         $hour_1 = $gio_bat_dau->hour;
        //         $mi_1   = $gio_bat_dau->minute;
        //         $hour_2 = $gio_ket_thuc->hour;
        //         $mi_2   = $gio_ket_thuc->minute;

        //         $thoi_gian_bat_dau  = Carbon::create($year, $month, $day, $hour_1, $mi_1, 0);
        //         $thoi_gian_ket_thuc = Carbon::create($year, $month, $day, $hour_2, $mi_2, 0);

        $data = $request->all();
        $data['id_phong'] = new ObjectId($data['id_phong']);
        $data['id_phim'] = new ObjectId($data['id_phim']);
        $data['thoi_gian_bat_dau'] = $data['thoi_gian_bat_dau']->toDateTimeString();
        $data['thoi_gian_ket_thuc'] = $data['thoi_gian_ket_thuc']->toDateTimeString();
        $lich_chieu = LichChieu::where('_id', $request->_id)->first();
        $lich_chieu->update($data);

        return response()->json([
            'status'    => true,
        ]);
    }
    // $ngay_bat_dau->addDay();
}
