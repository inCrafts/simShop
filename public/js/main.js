$('#currency').change(function () {
    window.location = 'currency/change?curr=' + $(this).val();
    console.log($(this).val());
});

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