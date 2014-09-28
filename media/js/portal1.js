$(document).ready(function () {

//    $("#choose_rate").on("click","li", select_slider);

//    $(".check_box_out").on("click", function() {$(this).toggleClass("check_box_out check_box_in"); });

//    $(".combine").on("click", combine);
//    $(".uncombine").on("click", uncombine);

    // кнопка плюс
    $("#order_options_plus").on("click", come_dop_option);
    $("#order_options_right h5").on("click", come_dop_option);
    // открытие и скрытие дополнительных параметров
    function come_dop_option() {
        $("#dop_options").slideToggle();
        $("#order_options_plus").toggleClass("minus plus");
    }
    // ---------------


  /*  $("#add_door").on("click", function() {$(this).parent().children('.smeta_door').eq(0).clone(true).insertBefore(this);
                                            var count = $('.smeta_door').length;
                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_count_interior_door_right').hide();
                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_count_interior_door_left').hide();
                                            $(this).parent().children('.smeta_door').eq(count-1).children('.ignore_door').hide();
                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_text_header').remove();
                                            $(this).parent().children('.smeta_door').eq(count-1).children('.choose_type_door').show();
    } );*/



    $("#toggle_room").on("click", room_toggle);

    $(".last_calculations_form").on("click", function() { $("#last_calculations_pop-up").show(); });
    $(".last_calculations_pop-up_close").on("click", function() { $("#last_calculations_pop-up").hide(); });

  /*  $(".smeta_count_window_one").on("click", window_choose);
    $(".smeta_count_window_two").on("click", window_choose);
    $(".smeta_count_window_three").on("click", window_choose);*/

   /* $(".smeta_count_interior_door_one").on("click", door_choose);
    $(".smeta_count_interior_door_two").on("click", door_choose);*/


    $(".selectbox2").selectbox({
        classHolder: 'sbHolder2',
        classSelector: 'sbSelector2',
        classOptions: 'sbOptions2'
        });

    $(".selectbox").selectbox();

    $("#rus_flag").on("click", function() { $("#uk_select").hide(); $("#rus_select").show();});
    $("#uk_flag").on("click", function() { $("#rus_select").hide(); $("#uk_select").show();});

    $(".ignore_2").on("click", function() {$(this).toggleClass("ignore_2 ignored_2"); });
    $(".ignore_3").on("click", function() {$(this).toggleClass("ignore_3 ignored_3"); });


    $("#page_up").on("click", function(){ $.scrollTo(0, 0); });


}).on("scroll", visible);






//function combine(){
//    $('.combine').hide();
//    $('#bath').slideUp();
//    $('#toilet').slideUp(400, function() { $('#bath_and_toilet').slideDown(400, function() {$('.uncombine').fadeIn(); }); });
//}
//
//function uncombine() {
//    $('.uncombine').hide();
//    $('#bath_and_toilet').slideUp(400, function() {
//        $('#toilet').slideDown();
//        $('#bath').slideDown(400, function() {$('.combine').fadeIn(); });
//
//    });
//}






//
//function select_slider() {
//    $("#choose_rate li").removeClass("choose_rate_selected");
//    $(this).addClass("choose_rate_selected");
//
//    var id = $(this).attr("id");
//    if (id == 'choose_rate_econom') {
//        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
//        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
//        setTimeout(function(){ $("#examples_works_slider_econom").show(function() {$("#examples_works_slider_econom").children('div').fadeIn(); }); }, 500);
//    }
//    if (id == 'choose_rate_standart') {
//        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
//        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
//        setTimeout(function(){ $("#examples_works_slider_standart").show(function() {$("#examples_works_slider_standart").children('div').fadeIn(); }); }, 500);
//
//    }
//    if (id == 'choose_rate_premium') {
//        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
//        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
//        setTimeout(function(){ $("#examples_works_slider_premium").show(function() {$("#examples_works_slider_premium").children('div').fadeIn(); }); }, 500);
//    }
//}



// сворот материалов комнаты
function room_toggle() {
    $(".materials_room_for_options").slideToggle();
    $(this).toggleClass("arrow_up arrow_down");
}
//--------------------


// выбор типа окна
/*
function window_choose() {
    var cl_w = $(this).attr('class');

    $(this).parent().hide();
    $(this).parent().parent().children('.smeta_count_window_right').show();
    $(this).parent().parent().children('.smeta_count_window_left').show();
    $(this).parent().parent().children('.ignore_window').show();

    if (cl_w == 'smeta_count_window_one') {
    $(this).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "70px", "background-position" : "0 25px"});
    }

    if (cl_w == 'smeta_count_window_two') {
        $(this).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "80px", "background-position" : "-79px 25px"});
    }

    if (cl_w == 'smeta_count_window_three') {
        $(this).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "120px", "background-position" : "-195px 25px"});
    }

}*/
//----------------------



// выбор типа двери
/*function door_choose() {
    var cl_d = $(this).attr('class');

    $(this).parent().hide();
    $(this).parent().parent().children('.smeta_count_interior_door_right').show();
    $(this).parent().parent().children('.smeta_count_interior_door_left').show();
    $(this).parent().parent().children('.ignore_door').show();

    if (cl_d == 'smeta_count_interior_door_one') {
        $(this).parent().parent().children('.smeta_count_interior_door_left').children('.smeta_count_interior_door_chosen').css({"width" : "70px", "background-position" : "0 25px"});
    }

    if (cl_d == 'smeta_count_interior_door_two') {
        $(this).parent().parent().children('.smeta_count_interior_door_left').children('.smeta_count_interior_door_chosen').css({"width" : "120px", "background-position" : "-86px 25px"});
    }

}*/
//----------------------



//function authorization() {
//    $("#overlap").show();
//    $("#pop_up").show();
//    $("#close_pop_up").show();
//}
//
//function close_authorization() {
//    $("#overlap").hide();
//    $("#pop_up").hide();
//    $("#close_pop_up").hide();
//}

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