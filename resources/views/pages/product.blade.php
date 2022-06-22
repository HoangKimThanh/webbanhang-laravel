@extends('layout.main')

@section('content')
    <div class="main">
        <div class="container">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-12 m-12 c-0">
                        <div class="navigation">
                            <ul class="navigation-list">
                                <li>
                                    <a href="./trang-chu">Trang chủ</a>
                                    <span>&rarr;</span>
                                </li>
                                <li>
                                    <a href="cua-hang">Cửa hàng</a>
                                </li>
                                <span>&rarr;</span>
                                <li>
                                    <a href="cua-hang?product_category_id="></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col l-3 m-0 c-0">
                        <nav class="category">
                            <ul>
                                <li class="category-detail">
                                    <a href="./cua-hang" style="font-weight: bold">Tất cả
                                    </a>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="" style="">
                                                    {{ $category->name }}
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
                                <!-- <div class="btn btn--white">Nổi bật</div>
                                        <div class="btn btn--white btn--active">Tất cả</div>
                                        <div class="btn btn--white">Bán Chạy</div> -->
                                <select name="price-sort" id="price-sort" class="btn btn--white">
                                    <option value="asc" class="price-sort-option">Giá: Thấp đến cao</option>
                                    <option value="desc" class="price-sort-option">
                                        Giá: Cao đến thấp
                                    </option>
                                </select>
                            </div>
                            <div class="filter-footer">
                                <span class="page">
                                    <?php
                                    //$result = get_products_by_product_category($conn, $product_category_id, $product_per_page, $offset, $sort);
                                    //$num_rows = mysqli_num_rows($result);
                                    ?>
                                    {{-- <span class="highlight"></span> /
                                    <span class="total"></span> --}}
                                </span>
                                <!-- <a href="#" class="filter-btn-left btn btn--white btn--disable">
                                            <i class="fas fa-angle-left"></i>
                                        </a>
                                        <a href="#" class="filter-btn-right btn btn--white">
                                            <i class="fas fa-angle-right"></i>
                                        </a> -->
                            </div>
                        </div>
                        <div class="products">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col l-4 m-4 c-6">
                                        <a href="cua-hang/" class="product">
                                            <div class="box-img">
                                                <img class="product__image"
                                                    src="{{ asset('img/uploads/' . $product->image_main) }}" alt="">
                                            </div>
                                            <div class="product__detail">
                                                <h4 class="product__name"></h4>
                                                <div class="product__price">
                                                    <span
                                                        class="@if ($product->new_price != null) @php 
                                                            echo 'product__price-old';
                                                        @endphp @endif">{{ $product->old_price }}</span>

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
                        {{-- <div class="pagination">
                        <ul>
                            <!-- <li class="btn prev">
                                <span><i class="fas fa-angle-left"></i></span>
                            </li> -->
                            <?php
                            //for($i = 1; $i <= $num_page; $i++) {
                            ?>
                            <li class="btn--white <?php //if($page == $i) echo 'btn--active'
                            ?>">
                                <a href="cua-hang<?php
                                // if ($product_category_id != 0) {
                                //     echo '?product_category_id=' . $product_category_id . '&';
                                // } else {
                                //     echo '?';
                                // }
                                // echo 'page=' . $i;
                                // if(isset($_GET['sort']) && !empty($_GET['sort']))
                                //     echo '&sort='.$_GET['sort'];
                                ?>"><?php //echo $i
                                ?></a>
                            </li>
                            <?php } ?>
                            <!-- <li class="btn--white next">
                                <span><i class="fas fa-angle-right"></i></span>
                            </li> -->
                        </ul>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
