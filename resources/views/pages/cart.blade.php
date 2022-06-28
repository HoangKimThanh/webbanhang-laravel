@extends('layouts.main')

@section('content')
    <div class="main">
        <div class="cart">
            <div class="grid wide">
                @if ($cart != null)
                    <div class="row cart-table" style="display: flex">
                        <div class="col l-8 m-12 c-12">
                            <div class="cart-detail">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>SẢN PHẨM</th>
                                            <th>TÊN SẢN PHẨM</th>
                                            <th>SL</th>
                                            <th>THÀNH TIỀN</th>
                                            <th>XÓA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr class="product-id_{{ $item['id'] }}">
                                                <td>
                                                    <a href="{{ route('products.show', [$item['url'], $item['id']]) }}">
                                                        <img src="{{ asset('img/uploads/' . $item['image_main']) }}"
                                                            width="100">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('products.show', [$item['url'], $item['id']]) }}">{{ $item['name'] }}</a>
                                                </td>
                                                <td>
                                                    <button data-id="{{ $item['id'] }}"
                                                        class="sub btn-quantity-change">-</button>
                                                    <span
                                                        class="quantity_{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                                    <button data-id="{{ $item['id'] }}"
                                                        class="add btn-quantity-change">+</button>
                                                </td>
                                                <td>
                                                    <span data-price="{{ $item['new_price'] ?? $item['old_price'] }}"
                                                        class="price_{{ $item['id'] }}">{{ $item['quantity'] * $item['price'] }}</span>
                                                </td>
                                                <td>
                                                    <button data-id="{{ $item['id'] }}" class="btn-delete" title="Xóa"
                                                        style="cursor: pointer; padding: 4px; background-color: white; border: 1px solid #000">X</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col l-4 m-12 c-12">
                            <div class="cart-money">
                                <table>
                                    <caption>TỔNG TIỀN GIỎ HÀNG</caption>
                                    <tbody>
                                        <tr>
                                            <td>TỔNG SẢN PHẨM</td>
                                            <td>
                                                <span class="product-total">
                                                    @php
                                                        echo count($cart);
                                                    @endphp
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>TỔNG TIỀN HÀNG</td>
                                            <td>
                                                <span class="total_1">
                                                    {{ Session::get('cart_total') }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>TẠM TÍNH</td>
                                            <td>
                                                <span class="total_2">
                                                    {{ Session::get('cart_total') }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="button">
                                    <a href="{{ route('products') }}" class="btn btn--ccc">Tiếp tục mua sắm</a>
                                    <a href="{{ route('order') }}" class="btn">Đặt hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-empty" style="display: none">
                        <a href="{{ route('products') }}" style="display: block; text-align: center">
                            <img style="display: block; width: 50%; margin: 0 auto;"
                                src="{{ asset('img/empty-cart.jpg') }}" />
                        </a>
                    </div>
                @else
                    <a href="{{ route('products') }}" style="display: block; text-align: center">
                        <img style="display: block; width: 50%; margin: 0 auto;"
                            src="{{ asset('img/empty-cart.jpg') }}" />
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let quantityChangeBtns = document.querySelectorAll('.btn-quantity-change');
        let deleteBtns = document.querySelectorAll('.btn-delete');
        quantityChangeBtns.forEach(element => {
            element.onclick = function() {
                id = $(this).data('id');
                let quantityElement = document.querySelector('.quantity_' + id);
                let quantity = parseInt(quantityElement.innerText);

                let productPriceElement = document.querySelector('.price_' + id);
                let productPrice = parseInt(productPriceElement.getAttribute('data-price'));

                let total = ($('.total_1').text());

                if (this.classList.contains('add')) {
                    quantity++;
                    total = parseInt(total) + productPrice;
                } else if (this.classList.contains('sub')) {
                    if (quantity > 1) {
                        quantity--;
                        total = parseInt(total) - productPrice;
                    }
                }

                quantityElement.innerText = quantity;

                document.querySelector(`li[data-id="${id}"] .cart__list-item-quanlity`).innerText = quantity;

                productPriceElement.innerText = productPrice * quantity;

                document.querySelectorAll("[class^=total]").forEach(function(element) {
                    element.innerText = total;
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cart-ajax') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        quantity: quantity,
                        action: 'update'
                    },
                    dataType: 'json',
                    success: function(data) {
                        // $('#app').html(data);
                    }
                })
            }
        });

        deleteBtns.forEach(function(btn) {
            btn.onclick = function() {
                let id = this.getAttribute('data-id');

                let price = parseInt(document.querySelector('.price_' + id).innerText);

                let total = parseInt(document.querySelector('.total_1').innerText);

                total = total - price;

                document.querySelector('.product-id_' + id).remove();

                document.querySelectorAll("[class^=total]").forEach(function(element) {
                    element.innerText = total;
                })

                let allItem = document.querySelectorAll("[class^=product-id]");
                if (allItem.length == 0) {
                    document.querySelector('.cart-empty').style.display = 'block';
                    document.querySelector('.cart-table').style.display = 'none';
                } else if (allItem.length > 0) {
                    document.querySelector('.product-total').innerText = allItem.length;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cart-ajax') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        action: 'delete'
                    },
                    dataType: 'json',
                    success: function(data) {
                        arr_result = data.str.split('OK');
                        if (arr_result[0] == '') {
                            $('.quantity-div').remove();
                        } else {
                            $('.quantity-div span').html(arr_result[0]);
                        }
                        $('.cart__list').html(arr_result[1]);
                    }
                })
            }
        })
    </script>
@endsection
