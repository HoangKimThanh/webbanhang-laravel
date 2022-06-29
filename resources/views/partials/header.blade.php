<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/qtip2/2.2.1/jquery.qtip.css">
    <link rel="shortcut icon" href="https://theme.hstatic.net/1000300840/1000422639/14/icon_nav_1.png?v=766"
        type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title> @yield('title') | Phụ Kiện UIT</title>
</head>

<body>
    <div id="app">
        <!---------------------------------------- Header ---------------------------------------->
        <header id="main-header">
            <div class="grid wide">
                <div class="header" id="header">
                    <!-- Logo on mobile and tablet -->
                    <a href="{{ route('home') }}" class="logo-on-tablet hide-on-pc hide-on-mobile">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                    <nav class="header-nav">
                        <ul>
                            <!-- Logo on pc -->
                            <li class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('img/logo.png') }}" alt="">
                                </a>
                            </li>

                            <!-- Menu -->
                            <li class="menu">
                                <div class="menu__mobile" id="menu__mobile">
                                    <p class="menu__mobile-click hide-on-pc hide-on-tablet">
                                        <i class="fas fa-bars"></i>
                                        Danh mục
                                    </p>

                                    <ul class="menu-list">
                                        @auth('user')
                                            <li class="menu-list__products login__mobile hide-on-tablet hide-on-pc">
                                                <a>
                                                    <span>Tài khoản</span>
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="subMenu-list">
                                                    <li><a href="{{ route('user.edit') }}">Thông tin cá nhân</a></li>
                                                    <li><a href="{{ route('invoices.history') }}">Đơn đã mua</a></li>
                                                    <li><a href="{{ route('user.logout') }}">Đăng xuất</a></li>
                                                </ul>

                                            </li>
                                        @endauth

                                        @guest('user')
                                            <li class="login__mobile hide-on-tablet hide-on-pc">
                                                <a href="{{ route('user.login') }}">
                                                    Đăng nhập/Đăng ký
                                                    <i class="fas fa-user-circle"></i>
                                                </a>
                                            </li>
                                        @endguest
                                        <li><a href="{{ route('intro') }}">GIỚI THIỆU</a></li>
                                        <li><a href="{{ route('products') }}">PHỤ KIỆN MÁY TÍNH</a></li>
                                        <li><a href="{{ route('news') }}">TIN TỨC</a></li>
                                        <li><a href="{{ route('contact') }}">LIÊN HỆ</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="others">
                                <ul class="others-list">
                                    <li class="hide-on-mobile">
                                        <form method="get" action="{{ route('products.search') }}"
                                            class="header-search">
                                            <input name="q" type="text" placeholder="Tìm kiếm sản phẩm"
                                                title="Tìm kiếm sản phẩm">
                                            <button type="submit" title="Tìm kiếm">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('invoices.show') }}">
                                            <i class="fas fa-paw" title="Tra cứu đơn hàng"></i>
                                        </a>
                                    </li>
                                    <li class="hide-on-mobile user__item">
                                        @auth('user')
                                            <a>
                                                <i class="fas fa-user"></i>
                                                <i class="fas fa-caret-down"></i>
                                            </a>
                                            <ul class="user__info">
                                                <li class="user__info-item">
                                                    <a href="./thong-tin-ca-nhan" classss="user__info-item-link">Tài
                                                        khoản
                                                        của tôi</a>
                                                </li>
                                                <li class="user__info-item">
                                                    <a href="./lich-su-mua-hang" class="user__info-item-link">Đơn đã
                                                        mua</a>
                                                </li>
                                                <li class="user__info-item user__info-item--modifier">
                                                    <a href="{{ route('user.logout') }}"
                                                        class="user__info-item-link">Đăng xuất</a>
                                                </li>
                                            </ul>
                                        @endauth

                                        @guest('user')
                                            <a href="{{ route('login') }}">
                                                Đăng nhập/Đăng ký
                                            </a>
                                        @endguest
                                    </li>

                                    @php
                                        $isExistCart = Session::has('cart');
                                        $count = 0;
                                        if ($isExistCart) {
                                            $cart = Session::get('cart');
                                            $count = count($cart);
                                        }
                                    @endphp

                                    <!-- Cart thumbnail -->
                                    <li class="search-cart--wrap">
                                        <a class="cart__link" href="{{ route('cart') }}">
                                            <i class="fa fa-shopping-bag"></i>
                                            <div class="quantity-div">
                                                @if ($isExistCart && $count > 0)
                                                    <span>
                                                        @php
                                                            echo $count;
                                                        @endphp
                                                    </span>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="cart__list hide-on-mobile">
                                            @if ($isExistCart && $count > 0)
                                                <p class="cart__list-header">Sản Phẩm Mới Thêm</p>
                                                <ul class="cart__list-list">
                                                    @foreach ($cart as $item)
                                                        <li class="cart__list-item" data-id="{{ $item['id'] }}">
                                                            <a href="{{ route('products.show', [$item['url'], $item['id']]) }}"
                                                                class="cart__list-item-link">
                                                                <img class="cart__list-item-img"
                                                                    src="{{ asset('img/uploads/' . $item['image_main']) }}"
                                                                    alt="">

                                                                <div class="cart__list-item-description">
                                                                    <div class="cart__list-item-heading">
                                                                        <h4 class="cart__list-item-name">
                                                                            {{ $item['name'] }}</h4>

                                                                        <div class="cart__list-item-detail">
                                                                            <span
                                                                                class="cart__list-item-cost highlight">{{ $item['new_price'] ?? $item['old_price'] }}</span>
                                                                            <span
                                                                                class="cart__list-item-multiply">x</span>
                                                                            <span
                                                                                class="cart__list-item-quanlity">{{ $item['quantity'] }}</span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="cart__list-footer">
                                                    <a href="{{ route('cart') }}" class="btn">Xem Giỏ Hàng</a>
                                                </div>
                                            @else
                                                <img class="no-cart" src="{{ asset('img/no_cart.png') }}"
                                                    alt="">
                                                <p class="cart__list--empty">Chưa Có Sản Phẩm</p>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
