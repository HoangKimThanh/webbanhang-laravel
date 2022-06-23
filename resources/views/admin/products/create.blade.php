@extends('admin.layout.main')

@section('content')
    <div class="admin-content-right-category__add">
        <h1>Thêm sản phẩm</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            Chọn danh mục sản phẩm
            <select required name="category_id">
                <option value="">Chọn danh mục</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <br>

            Tên sản phẩm
            <input required type="text" name="name" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
            <br>

            <input type="hidden" name="url" value="1">

            Chi tiết
            <textarea name="detail" cols="30" id="detail" rows="10" placeholder="Nhập chi tiết">{{ old('detail') }}</textarea>
            <br>

            Mô tả
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
            <br>

            Giá sản phẩm
            <input required type="text" name="old_price" placeholder="Giá sản phẩm" value="{{ old('old_price') }}">
            <br>

            Giá khuyến mãi
            <input type="text" name="new_price" placeholder="Giá khuyến mãi" value="{{ old('new_price') }}">
            <br>

            Ảnh đại diện
            <input required type="file" name="image_main">
            <br>

            Ảnh mô tả
            <input type="file" name="images_description[]" multiple>
            <br>

            <input type="checkbox" name="featured"> Sản phẩm nổi bật

            <button type="submit" name="submit" value="submit">Thêm</button>
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
