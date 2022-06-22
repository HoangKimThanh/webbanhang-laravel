@extends('admin.layout.main')

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
            <br>
            <button type="submit" name="submit" value="submit">Thêm</button>
        </form>
    </div>
@endsection