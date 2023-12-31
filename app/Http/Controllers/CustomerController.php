<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterAccountRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Jobs\SendEmailResetPassword;
use App\Jobs\SendMailJob;
use App\Mail\KichHoatTaiKhoanMail;
use App\Models\Customer;
use App\Models\QuanLyBaiViet;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function viewThongTin()
    {
        return view('AdminRocker.page.KhachHang.index');
    }

    public function getData()
    {
        $data = Customer::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $phim = Customer::where('_id', $request->_id)->first();
        $phim->update($data);

        return response()->json([
            'status'    => true,
        ]);
    }

    public function destroy(Request $request)
    {
        Customer::where('_id', $request->_id)->first()->delete();

        return response()->json([
            'status'    => true,
        ]);
    }

    public function changeStatus($id)
    {
        $change = Customer::find(['_id' => $id])->first();
        if($change->loai_tai_khoan == -1) {
            $change->loai_tai_khoan = 1;
        } else  {
            $change->loai_tai_khoan = -1;
        }
        $change->save();
    }

    public function kichHoat($id)
    {
        $kickHoat = Customer::find(['_id' => $id])->first();
        if($kickHoat->loai_tai_khoan == 0) {
            $kickHoat->loai_tai_khoan = 1;
            $kickHoat['hash_mail'] = Str::uuid();
        }
        else if($kickHoat->loai_tai_khoan == 1) {
            $kickHoat->loai_tai_khoan = 0;
            $kickHoat['hash_mail'] = '';
        }
        $kickHoat->save();
    }

    public function actionUpdatePassword(UpdatePasswordRequest $request)
    {
        $customer = Customer::where('hash_reset', $request->hash_reset)->first();

        $customer->hash_reset = '';
        $customer->password = bcrypt($request->password);
        $customer->save();

        toastr()->success('Đã cập nhật mật khẩu thành công!');

        return redirect('/login');
    }

    public function viewUpdatePassword($hash)
    {
        $customer = Customer::where('hash_reset', $hash)->first();
        if($customer) {
            return view('client.cap_nhat_mat_khau', compact('hash'));
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }

    public function actionResetPassword(ResetPasswordRequest $request)
    {
        // Kiểm tra email có tồn tại trong database
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json([
                'status'  => false,
                'message' => 'Email không tồn tại trong hệ thống',
            ]);
        }

        // Tạo hash_reset và gửi email
        $hash = Str::uuid();
        $customer->hash_reset = $hash;
        $customer->save();

        SendEmailResetPassword::dispatch(['email' => $request->email, 'hash_reset' => $hash]);

        // Thông báo hoặc trả về JSON
        return response()->json([
            'status'    => true,
            'message'   => 'Vui lòng xác nhận email của bạn để đổi mật khẩu.'
        ]);
    }

    public function viewResetPassword()
    {
        return view('client.quen_mat_khau');
    }

    public function viewRegister()
    {
        return view('client.register');
    }


    public function actionRegister(RegisterAccountRequest $request)
    {
        $data = $request->all();
        $hash = Str::uuid(); // tạo ra 1 biến tên hash kiểu string có 36 ký tự không trùng với nhau
        $data['hash_mail'] = $hash->toString();
        $data['password']  = bcrypt($data['password']);
        Customer::create($data);

        // Phân cụm này qua JOB
        $dataMail['ho_va_ten'] = $request->ho_va_ten;
        $dataMail['email']     = $request->email;
        $dataMail['hash_mail'] = $hash;

        SendMailJob::dispatch($dataMail);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công. Vui lòng xác nhận email của bạn.'
        ]);
    }

    public function viewLogin()
    {
        return view('client.login');
    }

    public function thongBaoKichHoatTaiKhoan()
    {
        return view('client.thong_bao_kich_hoat_tai_khoan');
    }

    public function actionLogin(LoginRequest $request)
    {
        $data['email']      = $request->email;
        $data['password']   = $request->password;
        $check = Auth::guard('customer')->attempt($data);
        if($check) {
            $customer = Auth::guard('customer')->user();
            if($customer->loai_tai_khoan == -1) {
                toastr()->error("Tài khoản đã bị khóa!");
                Auth::guard('customer')->logout();
            } else if($customer->loai_tai_khoan == 0) {
                toastr()->warning("Tài khoản chưa được kích hoạt!");
                Auth::guard('customer')->logout();
            } else {
                toastr()->success("Đã đăng nhập thành công!");
            }
        } else {
            toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Đã đăng nhập tài khoản thành công'
        ]);
    }

    public function actionActive($hash)
    {
        $account = Customer::where('hash_mail', $hash)->first();
        if($account && $account->loai_tai_khoan == 0) {
            $account->loai_tai_khoan = 1;
            $account->hash_mail = '';
            $account->save();
            toastr()->success('Đã kích hoạt tài khoản thành công!');
        } else {
            toastr()->error('Thông tin không chính xác!');
        }

        return redirect('/login');
    }

    public function actionLogout()
    {
        Auth::guard('customer')->logout();
        Auth::logout();

        return redirect('/');
    }
}
