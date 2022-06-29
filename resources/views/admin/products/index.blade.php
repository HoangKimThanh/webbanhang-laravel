@extends('admin.layouts.main');

@section('title')
    Sản phẩm
@endsection

@section('content')
    <p><a href="{{ route('products.create') }}">Thêm sản phẩm</a></p>
    <h1 style="text-align: center;">Danh sách sản phẩm</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sản phẩm
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Giá ưu đãi</th>
                        <th>Ảnh đại diện</th>
                        <th>Tùy biến</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Giá ưu đãi</th>
                        <th>Ảnh đại diện</th>
                        <th>Tùy biến</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->old_price }}</td>
                            <td>{{ $product->new_price }}</td>
                            <td><img src="{{ asset('img/uploads/' . $product->image_main) }}" alt=""></td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('products.edit', $product) }}">Sửa</a> |
                                <form style="display: inline-block" action="{{ route('products.destroy', $product) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
