<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->validated());
        $user->save();

        $credentials = $request->only(['email', 'password']);

        Auth::guard('user')->attempt($credentials);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $remember = ($request->remember) ? true : false;
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard('user')->attempt($credentials, $remember)) {
            $user = User::where('email', '=', $request->email)->first();
            Session::put('user', $user);
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::find(Auth::guard('user')->user()->id);

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = User::find(Auth::guard('user')->user()->id);
        $user->update($request->validated());

        return back()->with('success', 'C???p nh???t th??ng tin c?? nh??n th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('user')->logout();
        Session::forget('user');
        Session::save();
        return redirect()->route('login');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
