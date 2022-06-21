@extends('admin.pages.main')

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Thêm danh mục</h1>
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Nhập tên danh mục" value="{{ old('name') }}">
            <br>
            @if ($errors->has('name'))
                <span class="text-danger" >
                    {{ $errors->first('name') }}
                </span>
            @endif

            <button type="submit" name="submit" value="submit">Thêm</button>
        </form>
    </div>
@endsection