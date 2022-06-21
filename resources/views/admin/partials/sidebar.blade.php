<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="admin-content-left">
                <ul>
                    <li>
                        <a href=""><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-thumbtack"></i> Danh mục sản phẩm</a>
                        <ul>
                            <li><a href="{{ route('categories.create') }}">Thêm danh mục</a></li>
                            <li><a href="{{ route('categories.index') }}">Danh sách danh mục</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-laptop"></i> Sản phẩm</a>
                        <ul>
                            <li><a href="">Thêm sản phẩm</a></li>
                            <li><a href="">Danh sách sản phẩm</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fas fa-shopping-cart"></i> 
                            Đơn hàng
                        </a>
                        <ul>
                            <li>
                                <a href="">
                                    Danh sách đơn hàng
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-user"></i> Khách hàng</a>
                        <ul>
                            <li><a href="">Danh sách khách hàng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa-solid fa-message"></i> 
                            Đánh giá
                        </a>
                        <ul>
                            <li>
                                <a href="">
                                    Danh sách đánh giá
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>