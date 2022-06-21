@extends('admin.pages.main')

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Sửa danh mục</h1>
        <form method="post" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" placeholder="Nhập tên danh mục" value="{{ $category->name }}">
            <br>
            @if ($errors->has('name'))
                <span class="text-danger" >
                    {{ $errors->first('name') }}
                </span>
            @endif
            
            <button type="submit" name="submit" value="submit">Sửa</button>
        </form>
    </div>
@endsection