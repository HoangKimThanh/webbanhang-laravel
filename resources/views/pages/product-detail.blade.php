@extends('layouts.main')

@section('content')
    <div class="main">
        <div class="grid wide">
            <div class="row">
                <div class="col l-6 m-6 c-12">
                    <div class="row">
                        <div class="col l-2 m-2 c-2">
                            <div class="row">
                                <div class="col l-12 m-12 c-12">
                                    <img class="product-imgs active" src="{{ asset('img/uploads/' . $product->image_main) }}"
                                        alt="" width="100%">
                                </div>
                                @foreach ($product->images_description as $img_description)
                                    <div class="col l-12 m-12 c-12">
                                        <img class="product-imgs" src="{{ asset('img/uploads/' . $img_description) }}"
                                            alt="" width="100%">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col l-10 m-10 c-10">
                            <img class="product-img-main" src="{{ asset('img/uploads/' . $product->image_main) }}"
                                alt="" width="100%">
                        </div>
                    </div>
                </div>

                <div class="col l-6 m-6 c-12">
                    <div class="product-box">
                        <h1 class="product-box__name">{{ $product->name }}</h1>
                        <br>
                        <p>
                            Giá:
                            <span
                                class="
                                    @if ($product->new_price != null) product__price-old'; @endif
                                "
                            >
                                {{ $product->old_price }}
                            </span>

                            @if ($product->new_price != null)
                                <span class="product__price-current highlight">
                                    {{ $product->new_price }}
                                </span>
                            @endif
                        </p>
                        <br>
                        <div class="product-select-quantity">
                            Số lượng:
                            <button class="sub btn-quantity-change">-</button>
                            <span class="quantity">1</span>
                            <button class="add btn-quantity-change">+</button>
                        </div>
                        <br>
                        <button class="add-to-cart">Thêm vào giỏ</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <h2>Chi tiết sản phẩm</h2>
                    <p class="product-box__detail">{!! $product->detail !!}</p>
                </div>

                <div class="col l-12 m-12 c-12">
                    <h2>Mô tả sản phẩm</h2>
                    <p class="product-box__description">{!! $product->description !!}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
