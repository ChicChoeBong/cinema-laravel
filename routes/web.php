<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GheBanController;
use App\Http\Controllers\GiaoDichController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LichChieuController;
use App\Http\Controllers\LoginSocialController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\QuanLyBaiVietController;
use App\Http\Controllers\TestController;
use App\Models\Phong;
use App\Models\QuanLyBaiViet;
use App\Models\QuanLyKhachHang;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\PaypalController;

//Ngân
Route::get('/', [HomepageController::class, 'index']);

//Q.Phúc
//Đăng ký, đăng nhập, thoát khách hàng
Route::get('/login', [CustomerController::class, 'viewLogin']);
Route::post('/login', [CustomerController::class, 'actionLogin']);
Route::get('/register', [CustomerController::class, 'viewRegister']);
Route::post('/register', [CustomerController::class, 'actionRegister']);
Route::get('/logout', [CustomerController::class, 'actionLogout']);
Route::get('/thong-bao', [CustomerController::class, 'thongBaoKichHoatTaiKhoan']);

// Route::get('/', function(){
//     echo env('APP_URL');
//     return view('welcome');
// })->name('home');
Route::get('chinh-sach-rieng-tu', function(){
    return '<h1>Chính sách riêng tư</h1>';
});
// Route::get('auth/facebook', function(){
//     return Socialite::driver('facebook')->redirect();
// });
// Route::get('auth/facebook/callback', function(){
//     dd()
//     // Log::debug([${Socialite::driver('facebook')->user()}]);
//     // $user = Socialite::driver('facebook')->user();
// });
Route::get('auth/facebook', [LoginSocialController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [LoginSocialController::class, 'redirectToFacebookCallback']);

Route::get('auth/google', [LoginSocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginSocialController::class, 'redirectToGoogleCallback']);

//Mạnh
//Reset password
Route::get('/update-password/{hash}', [CustomerController::class, 'viewUpdatePassword']);
Route::post('/update-password', [CustomerController::class, 'actionUpdatePassword']);
Route::get('/reset-password', [CustomerController::class, 'viewResetPassword']);
Route::post('/reset-password', [CustomerController::class, 'actionResetPassword']);

//Chi tiết bài viết
// Route::get('/bai-viet', [CustomerController::class, 'viewBaiViet']);
// Route::get('/bai-viet/detail/{id}', [CustomerController::class, 'viewBaiVietDetail']);

//Tín
//Đăng nhập Admin
Route::get('/admin/login', [AdminController::class, 'viewLogin']);
Route::post('/admin/login', [AdminController::class, 'actionLogin']);
Route::get('/admin/logout', [AdminController::class, 'actionLogout']);

//Lực
//Thông tin phim đang chiếu, sắp chiếu
Route::get('/phim-dang-chieu', [HomepageController::class, 'viewPhimDangChieu']);
Route::get('/phim-sap-chieu', [HomepageController::class, 'viewPhimSapChieu']);
Route::get('/chi-tiet-phim/{slug}', [HomepageController::class, 'chiTietPhim']);

//Ngân
//tìm kiếm
Route::post('/tim-kiem', [HomepageController::class, 'actionTimKiem']);

//Quốc
//Đặt vé, thanh toán
Route::group(['prefix' => '/client', 'middleware' => 'loginCustomer'], function () {
    Route::get('/dat-ve/{id_lich_chieu}', [LichChieuController::class, 'viewKhachHangDatVe']);
    Route::get('/hien-thi-ghe-ban/{id_lich_chieu}', [LichChieuController::class, 'showDataByIdLich']);
    Route::post('/dat-ve/giu-cho', [GheBanController::class, 'giuChoDatVe']);
    Route::post('/dat-ve/huy-cho', [GheBanController::class, 'huyChoDatVe']);
    Route::get('/thanh-toan', [GheBanController::class, 'thanhToan']);
    Route::get('/done', [GheBanController::class, 'done'])->name('done');
});

Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');
//Quốc
//Thanh toán bên thứ 3
Route::get('/auto', [GiaoDichController::class, 'auto']);
//Quốc
//Auto huỷ vé
Route::get('/e48c2936-ec56-4452-8e01-9ce7f1b38952', [GheBanController::class, 'huyVeAuto']);


Route::get('/admin/khach-hang/active/{hash}', [CustomerController::class, 'actionActive']);
//Admin
Route::group(['prefix' => '/admin', 'middleware' => 'loginAdmin'], function () {
    Route::get('/', [AdminController::class, 'viewHome']);

    //Quốc
    //Cấu hình homepage
    Route::group(['prefix' => '/cau-hinh'], function () {
        Route::get('/index', [ConfigController::class, 'index']);
        Route::post('/index', [ConfigController::class, 'store']);
    });

    //H.Phúc
    //Quản lý tài khoản khách hàng
    Route::group(['prefix' => '/khach-hang'], function() {
        Route::get('/active/thong-bao', [CustomerController::class, 'thongBaoKichHoatTaiKhoan']);
        Route::get('/thong-tin', [CustomerController::class, 'viewThongTin']);
        Route::get('/data', [CustomerController::class, 'getData']);
        Route::post('/update', [CustomerController::class, 'update']);
        Route::post('/delete', [CustomerController::class, 'destroy']);
        Route::get('/change-status/{id}', [CustomerController::class, 'changeStatus']);
        Route::get('/kich-hoat/{id}', [CustomerController::class, 'kichHoat']);
    });

    //Tín
    //Quản lý tài khoản admin
    Route::group(['prefix' => '/tai-khoan'], function () {
        Route::get('/index', [AdminController::class, 'index']);
        Route::get('/index/data', [AdminController::class, 'getData']);
        Route::post('/create', [AdminController::class, 'store']);
    });

    //Mạnh
    //Quản lý phòng
    Route::group(['prefix' => '/phong'], function () {
        Route::get('/index', [PhongController::class, 'index']);
        Route::get('/data', [PhongController::class, 'getData']);
        Route::post('/index', [PhongController::class, 'store']);
        Route::post('/update', [PhongController::class, 'update']);

        Route::get('/change-status/{id}', [PhongController::class, 'changeStatus']);
        Route::get('/delete/{id}', [PhongController::class, 'destroy']);
        Route::get('/edit/{id}', [PhongController::class, 'edit']);

        Route::get('/data-ghe/{id_phong}', [PhongController::class, 'getDataGhe']);
    });

    //H.Phúc
    //Quản lý phim
    Route::group(['prefix' => '/phim'], function () {
        Route::get('/index', [PhimController::class, 'index']);
        Route::post('/create', [PhimController::class, 'store']);
        Route::get('/data', [PhimController::class, 'getData']);

        Route::get('/index-vue', [PhimController::class, 'indexVue']);
        Route::post('/index-vue', [PhimController::class, 'storeVue']);

        Route::post('/delete', [PhimController::class, 'destroy']);
        Route::post('/update', [PhimController::class, 'update']);
    });

    //Lực
    //Quản lý lịch chiếu
    Route::group(['prefix' => '/lich-chieu'], function () {
        Route::get('/index', [LichChieuController::class, 'index'])->name('tao_nhieu_buoi');
        Route::post('/index', [LichChieuController::class, 'store']);

        Route::get('/data', [LichChieuController::class, 'getData']);

        Route::get('/thoi-khoa-bieu', [LichChieuController::class, 'viewThoiKhoaBieu']);
        Route::get('/data-thoi-khoa-bieu', [LichChieuController::class, 'dataThoiKhoaBieu']);

        Route::get('/tao-mot-buoi', [LichChieuController::class, 'viewTaoMotBuoi'])->name('tao_mot_buoi');
        Route::post('/tao-mot-buoi', [LichChieuController::class, 'actionTaoMotBuoi']);
        Route::post('/update', [LichChieuController::class, 'update']);

        Route::post('/xoa-lich', [LichChieuController::class, 'destroy']);

        Route::get('/danh-sach-ghe/{id_lich}', [GheBanController::class, 'getData']);
        Route::post('/danh-sach-ghe/doi-trang-thai', [GheBanController::class, 'doiTrangThaiGheBan']);
    });


    //Quản lý bài viết
    // Route::group(['prefix' => '/bai-viet'], function() {
    //     Route::get('/index', [QuanLyBaiVietController::class, 'index']);
    //     Route::post('/create', [QuanLyBaiVietController::class, 'createBaiViet']);
    //     Route::post('/update', [QuanLyBaiVietController::class, 'updateBaiViet']);
    //     Route::get('/data', [QuanLyBaiVietController::class, 'getData']);
    //     Route::get('/status/{id}', [QuanLyBaiVietController::class, 'doiTrangThai']);
    //     Route::post('/delete', [QuanLyBaiVietController::class, 'delete']);
    // });
});

//Upload image
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
