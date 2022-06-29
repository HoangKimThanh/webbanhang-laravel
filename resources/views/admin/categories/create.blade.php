@extends('admin.layouts.main')

@section('title')
    Thêm danh mục
@endsection

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Thêm danh mục</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Nhập tên danh mục" value="{{ old('name') }}">
            <input type="hidden" name="url" value="1">
            <br>
            <button type="submit" name="submit" value="submit">Thêm</button>
        </form>
    </div>
@endsection
