@extends('layouts.main')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <div class="main">
        <div class="sign signin">
            <div class="grid wide">
                <h3 class="sign__heading">Đăng nhập</h3>
                <div class="row">
                    <div class="col l-6 m-6 c-12">
                        <div class="sign-left">
                            <h4>Đăng nhập bằng tài khoản đã có:</h4>
                            <p class="message"><span class="highlight"></span></p>
                            <form action="{{ route('user.login') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col l-5 m-5 c-12">
                                        <label for="signin-email" class="">
                                            Email của bạn:
                                        </label>
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <input value="{{ old('email') ?? Cookie::get('email') }}" required type="email" name="email" id="signin-email"
                                            placeholder="Email của bạn...">
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                        <label for="signin-password">
                                            Mật khẩu:
                                        </label>
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <input value="{{ Cookie::get('password') }}" required type="password" name="password"
                                            id="signin-password" placeholder="Mật khẩu của bạn...">
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <label for="sign-save">
                                            <input type="checkbox" name="remember" id="sign-save" >
                                            Ghi nhớ đăng nhập?
                                        </label>
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <a href="quen-mat-khau">Quên mật khẩu?</a>
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <button type="submit" name="submit" class="btn" value="submit">Đăng
                                            nhập</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col l-6 m-6 c-12">
                        <div class="sign-right">
                            <h4>Khách hàng mới của PhuKienHKT</h4>
                            <p>
                                Đăng ký ngay nếu bạn chưa có tài khoản trên {{ route('/') }}
                            </p>

                            <p>
                                Tạo tài khoản giúp bạn có trải nghiệm thú vị và quá trình mua hàng trở nên nhanh chóng hơn!
                            </p>

                            <a href="{{ route('register') }}" class="btn">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
