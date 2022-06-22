@extends('layout.main')

@section('content')
    <div class="main-mobile main-tablet">
        <div class="slider">
            <div class="slider-imgs">
                <a href="cua-hang"><img src="{{ asset('img/slider-1.jpg') }}" alt=""></a>
                <a href="cua-hang"><img src="{{ asset('img/slider-2.jpg') }}" alt=""></a>
                <a href="cua-hang"><img src="{{ asset('img/slider-3.jpg') }}" alt=""></a>
                <a href="cua-hang"><img src="{{ asset('img/slider-4.jpg') }}" alt=""></a>
            </div>

            <div class="slider-dots">
                <div class="slider-dot slider-dot--active"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
                <div class="slider-dot"></div>
            </div>
        </div>

        <div class="top-news">
            <h3>Tin tức nổi bật</h3>
            <ul class="autoWidth cs-hidden">
                <li>
                    <a href="tin-tuc" class=" box">
                        <div class="box-img">
                            <img class="news__image" src="{{ asset('img/news-1.jpg') }}" alt="">
                        </div>
                        <div class="news__detail">
                            <h4 class="news__title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
                            <p class="news__content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                                porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                                libero, sit amet commodo magna eros quis urna.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="tin-tuc" class=" box">
                        <div class="box-img">
                            <img class="news__image" src="{{ asset('img/news-2.jpg') }}" alt="">
                        </div>
                        <div class="news__detail">
                            <h4 class="news__title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
                            <p class="news__content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                                porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                                libero, sit amet commodo magna eros quis urna.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="tin-tuc" class=" box">
                        <div class="box-img">
                            <img class="news__image" src="{{ asset('img/news-3.jpg') }}" alt="">
                        </div>
                        <div class="news__detail">
                            <h4 class="news__title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
                            <p class="news__content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                                porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                                libero, sit amet commodo magna eros quis urna.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="tin-tuc" class=" box">
                        <div class="box-img">
                            <img class="news__image" src="{{ asset('img/news-4.jpg') }}" alt="">
                        </div>
                        <div class="news__detail">
                            <h4 class="news__title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
                            <p class="news__content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                                porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                                libero, sit amet commodo magna eros quis urna.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="tin-tuc" class=" box">
                        <div class="box-img">
                            <img class="news__image" src="{{ asset('img/news-5.jpg') }}" alt="">
                        </div>
                        <div class="news__detail">
                            <h4 class="news__title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h4>
                            <p class="news__content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas
                                porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada
                                libero, sit amet commodo magna eros quis urna.</p>
                        </div>
                    </a>
                </li>
            </ul>
            <a href="tin-tuc" class="btn">Xem thêm</a>
        </div>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/lightslider.js') }}"></script>
    </div>
@endsection
