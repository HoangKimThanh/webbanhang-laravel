<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}