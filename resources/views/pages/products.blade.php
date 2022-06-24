@extends('layouts.main')

@section('content')
    <div class="main">
        <div class="container">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-12 m-12 c-0">
                        <div class="navigation">
                            <ul class="navigation-list">
                                <li>
                                    <a href="{{ route('home') }}">Trang chủ</a>
                                    <span>&rarr;</span>
                                </li>
                                <li>
                                    <a href="{{ route('products') }}">Cửa hàng</a>
                                </li>
                                @if ($selectedCategory)
                                    <span>&rarr;</span>
                                    <li>
                                        {{ $selectedCategory->name }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col l-3 m-0 c-0">
                        <nav class="category">
                            <ul>
                                <li class="category-detail">
                                    <a href="{{ route('products') }}"
                                        style="@if (!$selectedCategory) font-weight: bold @endIF">
                                        Tất cả
                                        <span>({{ $total_products }})</span>
                                    </a>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                @php
                                                    // dd($selectedCategory->id, $category->id)
                                                @endphp
                                                <a href="{{ route('products.filter', [$category->url, $category->id]) }}"
                                                    style="
                                                        @isset($selectedCategory) @if ($selectedCategory->id == $category->id)
                                                                font-weight: bold @endif
                                                        @endisset">
                                                    {{ $category->name }}
                                                    <span>({{ $category->total }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col l-9 m-12 c-12">
                        <div class="filter hide-on-mobile hide-on-tablet">
                            <div class="filter-header">
                                <span class="filter__sort">Sắp xếp theo</span>
                                <select name="price-sort" id="price-sort" class="btn btn--white">
                                    <option value="asc" class="price-sort-option">
                                        Giá: Thấp đến cao
                                    </option>
                                    <option value="desc" class="price-sort-option">
                                        Giá: Cao đến thấp
                                    </option>
                                </select>
                            </div>

                            {{ $products->links('vendor.pagination.header') }}
                        </div>
                        <div class="products">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col l-4 m-4 c-6">
                                        <a href="{{ route('products.show', [$product->url, $product->id]) }}"
                                            class="product">
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
                            </div>
                        </div>

                        {{ $products->links('vendor.pagination.footer') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
