// Cart scripts starts

$('body').on('click', '.add-to-cart-link', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
        mod = $('.available select').val();
    $.ajax({
        url: '/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function(res) {
            showCart(res);
    },
        error: function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function () {
   let id = $(this).data('id');
   $.ajax({
      url: '/cart/delete',
      data: {id: id},
      type: 'GET',
      success: function (res) {
          showCart(res);
      },
       error: function () {
          alert('Ошибка!');

       }
   });
});

function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if ($('.cart-sum').text()) {
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Корзина пуста');
    }
}

function getCart() {
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
}

function clearCart() {
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(res) {
            showCart(res);
        },
        error: function () {
            alert('Ошибка! Попробуйте позже');
        }
    });
    return false;
}
// Cart scripts ends


// Currency scripts

$('#currency').change(function () {
    window.location = 'currency/change?curr=' + $(this).val();
    console.log($(this).val());
});
// Currency scripts

// Modifications scripts

$('.available select').on('change', function () {
   let modId = $(this).val(),
       modColor = $(this).find('option').filter(':selected').data('title'),
       modPrice = $(this).find('option').filter(':selected').data('price'),
       basePrice = $('#base-price').data('base');
    if (modPrice) {
        $('#base-price').text( symbolLeft + modPrice + symbolRight);
    } else {
        $('#base-price').text(symbolLeft + basePrice + symbolRight);
    }
});
// Modifications scripts
