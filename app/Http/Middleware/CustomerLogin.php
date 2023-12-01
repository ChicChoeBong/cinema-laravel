<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLogin
{
    public function handle(Request $request, Closure $next)
    {
        $check = Auth::guard('customer')->check();
        $user_soc = Auth::user();
        if($check || $user_soc !== null) {
            $user = Auth::guard('customer')->user();
            // $user_soc = Auth::guard('user')->user();
            if ($user !== null) {
                if($user->loai_tai_khoan <= 0) {
                    toastr()->error('Tài khoản của bạn không đủ quyền truy cập!');
                    return redirect('/login');
                }
            }

            return $next($request);
        } else {
            toastr()->error('Chức năng này yêu cầu phải đăng nhập!');
            return redirect('/login');
        }
    }
}
