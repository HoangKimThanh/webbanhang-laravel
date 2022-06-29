@extends('layouts.main')

@section('title')
    Tìm kiếm sản phẩm
@endsection

@section('content')
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="row">
                    <p style="margin-left: 16px; margin-bottom: 16px; padding-right: 16px;">Kết quả tìm kiếm cho
                        <span style="font-weight: bold;">{{ $search }}</span>
                        <span style="font-weight: bold;">({{ count($products) }})</span>
                    </p>
                    <div class="col l-12 m-12 c-12">
                        <div class="products">
                            <div class="row">
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                        <div class="col l-3 m-4 c-6">
                                            <a href="{{ route('products.show', [$product->url, $product->id]) }}" class="product">
                                                <div class="box-img">
                                                    <img class="product__image"
                                                        src="{{ asset('img/uploads/' . $product->image_main) }}"
                                                        alt="">
                                                </div>
                                                <div class="product__detail">
                                                    <h4 class="product__name">{{ $product->name }}</h4>
                                                    <div class="product__price">
                                                        <span
                                                            class="
                                                            @if ($product->new_price != null) product__price-old @endif
                                                        ">
                                                            {{ $product->old_price }}
                                                        </span>

                                                        @if ($product->new_price != null)
                                                            <span class="product__price-current highlight">
                                                                {{ $product->new_price }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <img src="{{ asset('img/no_search_result.png') }}"
                                        style="width:50%; display:block; margin: 0 auto;" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
