<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Traffic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // dd(Invoice::getReneveCurrentWeek());
        $totalVisitors = Traffic::getTotalVisitors();
        $totalUsers = User::getTotalUsers();
        $totalInvoices = Invoice::getTotalInvoices();
        $totalRevenues = Invoice::getTotalRevenues();
        return view('admin.dashboard', [
            'totalVisitors' => $totalVisitors,
            'totalUsers' => $totalUsers,
            'totalInvoices' => $totalInvoices,
            'totalRevenues' => $totalRevenues,
        ]);
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

    public function ajax(Request $request)
    {
        $data = [];
        $data['visitors'] = Traffic::getDataStatistics();
        $data['revenues'] = Invoice::getDataStatistics();

        $period = $request->get('period');

        switch ($period) {
            case '0':
                $revenueLastWeek = Invoice::getRevenueLastWeek();
                $revenueCurrentWeek = Invoice::getRevenueCurrentWeek();
                $data['compare']['last'] = $revenueLastWeek;
                $data['compare']['current'] = $revenueCurrentWeek;
                break;
            case '1':
                $revenueLastMonth = Invoice::getRevenueLastMonth();
                $revenueCurrentMonth = Invoice::getRevenueCurrentMonth();
                $data['compare']['last'] = $revenueLastMonth;
                $data['compare']['current'] = $revenueCurrentMonth;
                break;
            case '2':
                $revenueLastYear = Invoice::getRevenueLastYear();
                $revenueCurrentYear = Invoice::getRevenueCurrentYear();
                $data['compare']['last'] = $revenueLastYear;
                $data['compare']['current'] = $revenueCurrentYear;
                break;
        }

        return response()->json(array(
            'result' => $data,
        ));
    }
}
