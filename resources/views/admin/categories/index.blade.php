@extends('admin.layouts.main')

@section('title')
    Danh mục
@endsection

@section('content')
    <p>
        <a href="{{ route('categories.create') }}">Thêm danh mục sản phẩm</a>
    </p>

    <h2 style="text-align: center">Danh sách danh mục sản phẩm</h2>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Tùy biến</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('categories.edit', $category) }}">Sửa</a> |
                        <form style="display:inline-block" action="{{ route('categories.destroy', $category) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
