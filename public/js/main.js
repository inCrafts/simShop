// Cart scripts

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

function showCart(cart) {
    console.log(cart);
}
// Cart scripts


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
