<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title> Document </title>
</head>

<body>
    <div id="app">
        <!---------------------------------------- Header ---------------------------------------->
        <header id="main-header">
            <div class="grid wide">
                <div class="header" id="header">
                    <!-- Logo on mobile and tablet -->
                    <a href="./trang-chu" class="logo-on-tablet hide-on-pc hide-on-mobile">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                    <nav class="header-nav">
                        <ul>
                            <!-- Logo on pc -->
                            <li class="logo">
                                <a href="./trang-chu">
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
                                        <?php
                                        // if (!$isLogged) {
                                        //     echo '<li class="login__mobile hide-on-tablet hide-on-pc">
                                        //         <a href="./dang-nhap">
                                        //             Đăng nhập/Đăng ký
                                        //             <i class="fas fa-user-circle"></i>
                                        //         </a>
                                        //     </li>';
                                        // } else {
                                        //     echo '
                                        //     <li class="menu-list__products login__mobile hide-on-tablet hide-on-pc">
                                        //         <a>
                                        //             <span>Tài khoản</span>
                                        //             <i class="fas fa-angle-down"></i>
                                        //         </a>
                                        //         <ul class="subMenu-list">
                                        //             <li><a href="thong-tin-ca-nhan">Thông tin cá nhân</a></li>
                                        //             <li><a href="lich-su-mua-hang">Đơn đã mua</a></li>
                                        //             <li><a href="dang-xuat">Đăng xuất</a></li>
                                        //         </ul>
                                        
                                        //     </li>';
                                        // }
                                        ?>
                                        <li><a href="./gioi-thieu">GIỚI THIỆU</a></li>
                                        <li><a href="./cua-hang">PHỤ KIỆN MÁY TÍNH</a></li>
                                        <!-- <?php
                                        //$result = get_all_product_categories($conn);
                                        //$num_rows = mysqli_num_rows($result);
                                        //if ($num_rows > 0) {
                                        //foreach($result as $each) {
                                        ?>
                                                <li class="menu-list__products">
                                                    <a href="./products.php?product_category_id=<?//php echo $each['id'] ?>">
                                                        <span><?php //echo $each['name'];
                                                        ?></span>
                                                    </a>
                                                </li>
                                        <?php
                                        //}}
                                        ?> -->
                                        <!-- <li class="menu-list__products">
                                            <a href="./products.php">
                                                <span>NỮ</span>
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <ul class="subMenu-list">
                                                <li><a href="./products.php">Sneaker</a></li>
                                                <li><a href="./products.php">Giày bốt</a></li>
                                                <li><a href="./products.php">Sandal</a></li>
                                            </ul>
                                            
                                        </li>
                                        <li class="menu-list__products">
                                            <a href="./products.php">
                                                <span>NAM</span>
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <ul class="subMenu-list">
                                                <li><a href="./products.php">Sneaker</a></li>
                                                <li><a href="./products.php">Giày bốt</a></li>
                                                <li><a href="./products.php">Sandal</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="./tin-tuc">TIN TỨC</a></li>
                                        <li><a href="./lien-he">LIÊN HỆ</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="others">
                                <ul class="others-list">
                                    <li class="hide-on-mobile">
                                        <form method="get" action="./tim-kiem" class="header-search">
                                            <input name="q" type="text" placeholder="Tìm kiếm sản phẩm"
                                                title="Tìm kiếm sản phẩm">
                                            <button type="submit" title="Tìm kiếm">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="./tra-cuu">
                                            <i class="fas fa-paw" title="Tra cứu đơn hàng"></i>
                                        </a>
                                    </li>
                                    <li class="hide-on-mobile user__item">
                                        {{-- <?php //if($isLogged) {
                                        ?>
                                            <a>
                                                <i class="fas fa-user"></i>
                                                <i class="fas fa-caret-down"></i>
                                            </a>
                                            <ul class="user__info">
                                                <li class="user__info-item">
                                                    <a href="./thong-tin-ca-nhan" classss="user__info-item-link">Tài khoản của tôi</a>
                                                </li>
                                                <li class="user__info-item">
                                                    <a href="./lich-su-mua-hang" class="user__info-item-link">Đơn đã mua</a>
                                                </li>
                                                <li class="user__info-item user__info-item--modifier">
                                                    <a href="./dang-xuat" class="user__info-item-link">Đăng xuất</a>
                                                </li>
                                            </ul>
                                        <?php
                                        //} else {
                                        ?>
                                            <a href="./dang-nhap">
                                                Đăng nhập/Đăng ký
                                            </a>
                                        <?php } ?> --}}

                                        <!-- <a href=''>
                                            <i class='fas fa-sign-out-alt' title='Đăng xuất'></i>
                                        </a> -->
                                    </li>

                                    <!-- Cart thumbnail -->
                                    <li class="search-cart--wrap">
                                        <a class="cart__link" href="./gio-hang">
                                            <i class="fa fa-shopping-bag"></i>
                                            <div class="quantity-div">
                                                <?php //if(isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) { echo '<span>' . count($_SESSION['cart']) . '</span>';}
                                                ?>
                                            </div>
                                        </a>
                                        <div class="cart__list hide-on-mobile">
                                            <?php //if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
                                            ?>
                                            {{-- <img class="no-cart" src="./assets/img/no_cart.png" alt="">
                                                <p class="cart__list--empty">Chưa Có Sản Phẩm</p> --}}
                                            <?php //} else {
                                            ?>

                                            <p class="cart__list-header">Sản Phẩm Mới Thêm</p>
                                            {{-- <ul class="cart__list-list">
                                                <?php// foreach($_SESSION['cart'] as $each) { ?> ?>
                                                <li class="cart__list-item" data-id="<?php //echo $each['id']
                                                ?>">
                                                    <a href="product_detail.php?id=<?php //echo $each['id']
                                                    ?>" class="cart__list-item-link">
                                                        <img class="cart__list-item-img" src="./assets/img/uploads/<?php //echo $each['image']
                                                        ?>" alt="">
                                                        
                                                        <div class="cart__list-item-description">
                                                            <div class="cart__list-item-heading">
                                                                <h4 class="cart__list-item-name"><?php //echo $each['name'];
                                                                ?></h4>
                                                                
                                                                <div class="cart__list-item-detail">
                                                                    <span class="cart__list-item-cost highlight"><?php //echo $each['new_price'];
                                                                    ?></span>
                                                                    <span class="cart__list-item-multiply">x</span>
                                                                    <span class="cart__list-item-quanlity"><?php// echo $each['quantity']; ?> ?></span>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- <div class="cart__list-item-body">
                                                                <div class="cart__list-item-type">
                                                                    <span class="cart__list-item-color">Màu: xanh</span>
                                                                    <span class="cart__list-item-size">Size: 43</span>
                                                                </div>
                                                                <span class="cart__list-item-remove">Xóa</span>
                                                            </div> -->
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php //}
                                                ?>
                                            </ul> --}}

                                            <div class="cart__list-footer">
                                                <a href="./gio-hang" class="btn">Xem Giỏ Hàng</a>
                                            </div>
                                            <?php //}
                                            ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
