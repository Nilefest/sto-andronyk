// clients, client more, employee, info, reports, stocks, work
$('html').on('click', 'img#rem_row', function () {
    $(this).parent().parent().remove();
});

// clients, employee, info, reports, stock
var h_client = 320;
var h_employee = 210;
var h_info = 320;
var h_reports = 320;
var h_stock = 385;
var h_work = 80;

var is_open = 0;
$("#add_b").click(function () {
    if (is_open == 0) {
        $("#add_win").stop().animate({ height: 320 }, 200);
        is_open = 1;
    } else {
        $("#add_win").stop().animate({ height: 40 }, 200);
        is_open = 0;
    }
});

// stock
$('html').on('click', 'img#close', function () {
    $(this).parent().parent().fadeOut(200);
});

$('html').on('click', 'img#buy', function () {
    $("#buy_count_" + $(this).parent().parent().attr("value")).fadeIn(200);
});

$('html').on('click', 'img#sell', function () {
    $("#sell_count_" + $(this).parent().parent().attr("value")).fadeIn(200);
});

// work more

var det_all = {
    1: ['Деталь 1', "12.00"],
    2: ['Деталь 2', "456.00"],
    3: ['Материал 3', "23.00"],
    4: ['Материал 4', "98.00"],
    5: ['Деталь 4', "2524.00"]
};

$('#det_add').click(function () {
    $('table#det_tab > tbody').prepend("<tr><td>" + $('#detail').val() + "</td><td>" + det_all[$('#detail').val()][0] + "</td><td>" + det_all[$('#detail').val()][1] + "</td><td>" + $('#det_count').val() + "</td><td><img src=\"./img/ico/rem.png\" alt=\"rem\" id=\"rem_row\"></td></tr>");
});
