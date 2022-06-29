@extends('layouts.main')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="main">
        <div class="sign signup">
            <div class="grid wide">
                <h3 class="sign__heading">Đăng ký</h3>
                <form method="post" id="form" action="{{ route('user.register') }}">
                    @csrf
                    <div class="row">
                        <div class="col l-6 m-6 c-12">
                            <div class="sign-left">
                                <h4>Thông tin khách hàng</h4>
                                <div class="row">
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-fullname">
                                                Họ tên:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <input type="text" name="name" id="signup-fullname"
                                                placeholder="Họ tên..." autocomplete="username">
                                            <br>
                                            <span class="form-message">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-email">
                                                Email:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <input type="email" name="email" id="signup-email" placeholder="Email..."
                                                autocomplete="email">
                                            <br>
                                            <span class="form-message">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-phone">
                                                Điện thoại:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <input type="text" name="phone" id="signup-phone"
                                                placeholder="Điện thoại..." autocomplete="phone">
                                            <br>
                                            <span class="form-message">
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-province">
                                                Tỉnh/TP:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <select name="province" id="signup-province">
                                            </select>
                                            <br>
                                            <span class="form-message">
                                                @error('province')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-district">
                                                Quận/Huyện:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <select name="district" id="signup-district">
                                                <option>Chọn Quận/Huyện</option>
                                            </select>
                                            <br>
                                            <span class="form-message">
                                                @error('district')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="signup-ward">
                                                Phường/Xã:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <select name="ward" id="signup-ward">
                                                <option>Chọn Xã/Phường</option>
                                            </select>
                                            <br>
                                            <span class="form-message">
                                                @error('ward')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-12 m-12 c-12">
                                        <div class="form-group">
                                            <label for="signup-address">
                                                Địa chỉ:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <textarea name="address" id="signup-address" rows="5"
                                                placeholder="Vui lòng điền chính xác thông tin địa chỉ: số nhà, đường, tổ/ấp" autocomplete="address"></textarea>
                                            <br>
                                            <span class="form-message">
                                                @error('address')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col l-6 m-6 c-12">
                            <div class="sign-right">
                                <h4>Thông tin mật khẩu</h4>
                                <div class="row">
                                    <div class="col l-6 m-12 c-12">
                                        <div class="form-group">
                                            <label for="signupPassword">
                                                Mật khẩu:<span class="highlight">*</span>
                                            </label>
                                            <br>
                                            <input type="password" name="password" id="signup-password"
                                                autocomplete="new-password" placeholder="Mật khẩu..."
                                                title="Mật khẩu tối thiểu 8 ký tự, bao gồm ít nhất 1 chữ hoa, chữ thường và số.">
                                            <br>
                                            <span class="form-message">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-12 m-12 c-12">
                                        <div class="form-group">
                                            <label for="signupPasswordAgain">
                                                <span>Nhập lại mật khẩu:<span class="highlight">*</span> </span>
                                            </label>
                                            <br>
                                            <input type="password" name="passwordConfirm" id="signup-passwordAgain"
                                                placeholder="Nhập lại mật khẩu..." autocomplete="new-password">
                                            <br>
                                            <span class="form-message">
                                                @error('passwordConfirm')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-12 m-12 c-12">
                                        <p>Bằng việc đăng ký, bạn đã đồng ý với các điều khoản của Laptop Store</p>
                                    </div>

                                </div>

                                <button name="submit" type="submit" id="submit" class="btn" value="submit">Đăng
                                    ký</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/administrative_unit.js') }}"></script>
    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        Validator({
            form: '#form',
            formGroupSelector: '.form-group',
            errorElement: '.form-message',
            rules: [
                Validator.isRequired('#signup-fullname', 'Vui lòng nhập đầy đủ họ tên'),
                Validator.isFullName('#signup-fullname', 'Vui lòng nhập đúng họ tên'),
                Validator.isRequired('#signup-email', 'Vui lòng nhập đầy đủ email'),
                Validator.isEmail('#signup-email', 'Vui lòng nhập đúng email'),
                Validator.isRequired('#signup-phone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#signup-phone', 'Vui lòng nhập đúng số điện thoại'),
                Validator.isRequired('#signup-province', 'Chọn tỉnh/thành'),
                Validator.isRequired('#signup-district', 'Chọn quận/huyện'),
                Validator.isRequired('#signup-address', "Vui lòng nhập địa chỉ"),
                Validator.isRequired('#signup-password', 'Vui lòng nhập mật khẩu'),
                Validator.minLength('#signup-password', 8),
                Validator.isStrong('#signup-password', 'Mật khẩu yếu'),
                Validator.isRequired('#signup-passwordAgain', 'Vui lòng nhập lại mật khẩu'),
                Validator.isConfirmed('#signup-passwordAgain', function() {
                    return document.querySelector('#form #signup-password').value;
                }, 'Mật khẩu nhập lại không chính xác'),

            ],
        })
    </script>
    <script src="https://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.js"></script>
    <script>
        $(document).ready(function() {
            $('input[title]').qtip();
        });
        $('input[title]').qtip({
            content: $(':focus').prop('title'),
            show: 'focus',
            hide: 'blur'
        });
    </script>
@endsection
