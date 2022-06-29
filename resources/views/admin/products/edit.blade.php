@extends('admin.layouts.main')

@section('title')
    Sửa sản phẩm
@endsection

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Sửa sản phẩm</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            Chọn danh mục sản phẩm
            <select required name="category_id">
                <option value="">Chọn danh mục</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id === $product->category_id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <br>

            Tên sản phẩm
            <input required type="text" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
            <br>

            Chi tiết
            <textarea name="detail" cols="30" id="detail" rows="10" placeholder="Nhập chi tiết">{{ $product->detail }}</textarea>
            <br>

            Mô tả
            <textarea name="description" cols="30" id="description" rows="10" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
            <br>

            Giá sản phẩm
            <input required type="text" name="old_price" placeholder="Giá sản phẩm" value="{{ $product->old_price }}">
            <br>

            Giá khuyến mãi
            <input type="text" name="new_price" placeholder="Giá khuyến mãi" value="{{ $product->new_price }}">
            <br>
            <br>

            Ảnh đại diện
            <img src="{{ asset('img/uploads/' . $product->image_main) }}" alt="" height="100px">
            <input type="hidden" name="image_old" value="<?php echo $product['image']; ?>">
            <br>
            <br>

            Đổi ảnh đại diện
            <input type="file" name="image_main">
            <br>
            <br>

            Ảnh mô tả
            <br>
            @foreach ($product->images_description as $image)
                <img src="{{ asset('img/uploads/' . $image) }}" alt="" width="100px">
            @endforeach
            <br>
            <br>

            Đổi ảnh mô tả (chọn lại các ảnh)
            <input type="file" name="images_description[]" multiple>

            <br>
            <br>

            <input type="checkbox" name="featured" @if ($product->featured) checked @endif /> Sản phẩm nổi bật

            <button type="submit" name="submit" value="submit">Cập nhật</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('detail');
        CKEDITOR.replace('description');
    </script>
@endsection
