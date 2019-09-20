// stock
$('.form_count').fadeOut(10);

$('html').on('click', 'img#close', function () {
    $(this).parent().parent().fadeOut(200);
});

$('html').on('click', 'img#buy', function () {
    $("#buy_count_" + $(this).parent().parent().attr("value")).fadeIn(200);
});

$('html').on('click', 'img#sell', function () {
    $("#sell_count_" + $(this).parent().parent().attr("value")).fadeIn(200);
});