@extends('admin.layouts.main')

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Sửa danh mục</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" placeholder="Nhập tên danh mục" value="{{ $category->name }}">
            <br>
            <button type="submit" name="submit" value="submit">Sửa</button>
        </form>
    </div>
@endsection
