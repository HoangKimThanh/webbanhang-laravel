
let quantityChangeBtns = document.querySelectorAll('.btn-quantity-change');
quantityChangeBtns.forEach(element => {
    element.onclick = function () {
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

$('.add-to-cart').click(function () {
    const id = $('#product_id').val();
    $.ajax({
        url: "{{ route('cart-ajax') }}",
        type: 'post',
        data: {
            id: id,
            quantity: $('.quantity').text(),
            action: 'add'
        },
        dataType: 'text',
        success: function (data) {
            arr_result = data.split('OK');
            $('.quantity-div').html(arr_result[0]);
            $('.cart__list').html(arr_result[1]);
        }
    })
})