<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function edit()
    {
        return view('admin.account');
    }

    public function update(UpdateAdminRequest $request)
    {
        $request->validated();

        $hashedPassword = Auth::guard('admin')->user()->password;
        if (!Hash::check($request->oldPassword, $hashedPassword)) {
            return back()->withErrors(['Mật khẩu hiện tại không đúng']);
        }

        if (!Hash::check($request->newPassword, $hashedPassword)) {
            $users = Admin::find(Auth::guard('admin')->user()->id);
            $users->password = bcrypt($request->newPassword);
            $users->save();
            return back()->with('success', 'Cập nhật mật khẩu thành công');
        } else {
            return back()->withErrors(['Mật khẩu mới trùng mật khẩu hiện tại']);
        }
    }
}
