@extends('admin.layouts.main')

@section('content')
    <div class="profile">
        @if (session()->has('success'))
            <input type="hidden" id="success" value="{{ session()->get('success') }}">
            <input type="hidden" id="url" value="{{ route('admin.dashboard') }}">
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.update') }}" method="post" id="form">
            @csrf
            @method('PUT')
            <span id="notice"></span>
            <div style="margin-bottom: 32px;">
                Nhập mật khẩu cũ:
                <br>
                <input type="password" name="oldPassword" id="oldPassword" value="">
            </div>

            <div style="margin-bottom: 32px;">
                Nhập mật khẩu mới:
                <br>
                <input type="password" name="newPassword" id="newPassword" value="">
            </div>

            <div style="margin-bottom: 32px;">
                Nhập lại mật khẩu mới:
                <br>
                <input type="password" name="newPasswordConfirm" id="newPasswordAgain" value="">
            </div>

            <div>
                <button name="submit" type="submit" value="submit" class="btn btn-primary" value="changePassword">Đổi mật
                    khẩu</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const elementSuccess = document.querySelector('#success');
        const elementUrl = document.querySelector('#url');
        if (elementSuccess) {
            alert(elementSuccess.value);
            window.location.replace(elementUrl.value);
        }
    </script>
@endsection
