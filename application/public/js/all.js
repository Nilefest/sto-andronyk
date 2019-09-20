// clients, client more, employee, info, reports, stocks, work
$('html').on('click', 'img#rem_row', function () {
    var id = $(this).attr('alt');
    $.ajax({
        method: "post",
        data: {
            rem: 1,
            id: id
        }/*,
        success: function(data){ alert(data); }/**/
    });
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
        $("#add_win").stop().animate({
            height: h_block
        }, 200);
        is_open = 1;
    } else {
        $("#add_win").stop().animate({
            height: 40
        }, 200);
        is_open = 0;
    }
});
