<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            // dd($user->id=='');
            // Kiểm tra nếu người dùng là admin và tài khoản đang hoạt động
            if ($user->role == 'admin' && $user->active=='1') {
                return $next($request);
            }

            // Nếu người dùng không phải admin và tài khoản bị vô hiệu hóa
            if ($user->role != 'admin' && $user->active=='0') {
                Auth::logout();  // Đăng xuất người dùng
                return redirect('/login')->with('error', 'Your account is deactivated. Please contact support.');
            }

            // Nếu người dùng không phải admin nhưng tài khoản đang hoạt động
        }

        // Nếu người dùng chưa đăng nhập
        return redirect('/login')->with('error', 'You need to log in.');
    }
}
