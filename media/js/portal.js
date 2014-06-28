$(document).ready(function () {

$("#add_review-go_registration").on("click", function() { $("#pop_up-add_review").fadeOut(400, function() {$("#registration").fadeIn(); }); });
    $("#add_review").on("click", add_review);
    
    $("#go_registration").on("click", function() {  $("#registration").show(); $("#authorization").slideUp(); });
    $("#go_authorization").on("click", function() { $("#authorization").slideDown(400, function() {$("#registration").hide(); }); });
    $("#send_password").on("click", function() { $("#authorization").slideDown(400, function() {$("#registration").hide(); }); });
    $("#leave_remind_password").on("click", function() { $("#authorization").show(); $("#remind_password").slideUp(); });
    $("#go_remind_password").on("click", function() { $("#remind_password").slideDown(400, function() {$("#authorization").hide(); }); });

    $("#order_options_plus").on("click", come_dop_option);
    $("#order_options_right h5").on("click", come_dop_option);

    $("#toggle_room").on("click", room_toggle);

    $(".selectbox2").selectbox({
        classHolder: 'sbHolder2',
        classSelector: 'sbSelector2',
        classOptions: 'sbOptions2'
        });
    $(".selectbox").selectbox();

    $(".ignore_3").on("click", function() {$(this).toggleClass("ignore_3 ignored_3"); });
//    $(".ignore_4").on("click", function() {$(this).toggleClass("ignore_4 ignored_4"); });


    $("#page_up").on("click", function(){ $.scrollTo(0, 0); });
    $("#top_right_stiker p").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )
    $("#top_right_stiker_rooms").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )

}).on("scroll", visible);

function add_review(){
    $("#overlap").show();
    $("#pop_up").show();
    $("#close_pop_up").show();
    $("#pop_up-add_review").show();
}


// открытие и скрытие дополнительных параметров
function come_dop_option() {
    $("#dop_options").slideToggle();
    $("#order_options_plus").toggleClass("minus plus");

}

// --------------




// сворот материалов комнаты
function room_toggle() {
    $(".materials_room_for_options").slideToggle();
    $(this).toggleClass("arrow_up arrow_down");
}
//--------------------



function visible() {
    var scroll=$(document).scrollTop();

    if (scroll > 500) {
        $("#page_up").fadeIn();
        $("#top_right_stiker").fadeIn();
    }
    else  {
        $("#page_up").fadeOut();
        $("#top_right_stiker").fadeOut();
    }

}