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
                                    <img class="product-imgs active"
                                        src="{{ asset('img/uploads/' . $product->image_main) }}" alt=""
                                        width="100%">
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
                        <input type="hidden" id="product_id" value="{{ $product->id }}">
                        <h1 class="product-box__name">{{ $product->name }}</h1>
                        <br>
                        <p>
                            Giá:
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

            <div class="row">
                <div class="col l-12 m-12 c-12">
                    <div class="review">
                        @if (count($reviews) > 0)
                        <h2>ĐÁNH GIÁ</h2>
                            <ul class="list-reviews">
                                @if(Session::has('tmpReview'))
                                    @php
                                        $tmpReview = Session::get('tmpReview');
                                    @endphp
                                    <li>
                                        <div class="head_review">
                                            <div class="user">
                                                <p>Nhận xét của bạn đang chờ được kiểm duyệt</p>
                                                <h3>@ <span>{{ $tmpReview['user_name'] }}</span></h3>
                                            </div>
                                            <div class="time">
                                                {{ $tmpReview['created_at'] }}
                                            </div>
                                        </div>
                                        <div class="body_review">
                                            <p class="review_content">{{ $tmpReview['content'] }}</p>
                                        </div>
                                    </li>
                                @endif
                                @foreach ($reviews as $review)
                                    <li>
                                        <div class="head_review">
                                            <div class="user">
                                                <h3>@ <span>{{ $review->user_name }}</span></h3>
                                            </div>
                                            <div class="time">
                                                {{ $review->created_at }}
                                            </div>
                                        </div>
                                        <div class="body_review">
                                            <p class="review_content">
                                                {{ $review->content }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="post" id="form" action={{ route('reviews.store') }}>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h2>Đánh giá của bạn</h2>
                            <div class="row">
                                @if (Session::has('user'))
                                    <input type="hidden" name="user_name" value="{{ Session::get('user.name') }}">
                                    <input type="hidden" name="user_email" value="{{ Session::get('user.email') }}">
                                @else
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="name">
                                                <p>
                                                    Họ và tên
                                                </p>
                                            </label>
                                            <input id="name" type="text" name="user_name" placeholder="Họ và tên">
                                            <span class="form-message">
                                                @error('user_name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <div class="form-group">
                                            <label for="email">
                                                <p>
                                                    Email
                                                </p>
                                            </label>
                                            <input id="email" type="text" name="user_email" placeholder="Email">
                                            <span class="form-message">
                                                @error('user_email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content">
                                    <p>
                                        Nội dung đánh giá
                                    </p>
                                </label>
                                <textarea id="content" name="content" cols="30" rows="8" placeholder="Nội dung đánh giá"></textarea>
                                <span class="form-message">
                                    @error('content')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" name="submit" value="review">
                                Gửi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let quantityChangeBtns = document.querySelectorAll('.btn-quantity-change');
        quantityChangeBtns.forEach(element => {
            element.onclick = function() {
                let quantityElement = document.querySelector('.quantity');
                let quantity = parseInt(quantityElement.innerText);
                if (this.classList.contains('add')) {
                    quantity++;
                    quantityElement.innerText = quantity;
                } else if (this.classList.contains('sub')) {
                    if (quantity > 1) {
                        quantity--;
                    }
                    quantityElement.innerText = quantity;
                }
            }
        });

        let productImgs = document.querySelectorAll('.product-imgs');
        productImgs.forEach(productImg => {
            productImg.onclick = () => {
                if (!productImg.classList.contains('active')) {
                    document.querySelector('.product-imgs.active').classList.remove('active');
                    productImg.classList.add('active');
                    document.querySelector('.product-img-main').src = productImg.src;
                }
            }
        })

        $('.add-to-cart').click(function() {
            const id = $('#product_id').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('cart-ajax') }}",
                type: 'post',
                data: {
                    id: id,
                    quantity: $('.quantity').text(),
                    action: 'add'
                },
                dataType: 'json',
                success: function(data) {
                    arr_result = data.str.split('OK');
                    $('.quantity-div').html(arr_result[0]);
                    $('.cart__list').html(arr_result[1]);
                }
            })
        })
    </script>
    <script src="{{ asset('js/validator.js') }}"></script>
    <script>
        if (document.getElementById('name')) {
            Validator({
                form: '#form',
                formGroupSelector: '.form-group',
                errorElement: '.form-message',
                rules: [
                    Validator.isRequired('#name', 'Vui lòng nhập đầy đủ họ tên'),
                    Validator.isFullName('#name', 'Vui lòng nhập đúng họ tên'),
                    Validator.isRequired('#email', 'Vui lòng nhập email'),
                    Validator.isEmail('#email', 'Vui lòng nhập đúng email'),
                    Validator.isRequired('#content', "Vui lòng nhập nội dung"),

                ],
            })
        } else {
            Validator({
                form: '#form',
                formGroupSelector: '.form-group',
                errorElement: '.form-message',
                rules: [
                    Validator.isRequired('#content', "Vui lòng nhập nội dung"),

                ],
            })
        }
    </script>
@endsection
