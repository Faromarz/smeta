$(document).ready(function () {

    $("#privat p").on("click", authorization);
    $("#close_pop_up").on("click", close_authorization);
    $("#go_registration").on("click", function() {  $("#registration").show(); $("#authorization").slideUp(); });
    $("#go_authorization").on("click", function() { $("#authorization").slideDown(400, function() {$("#registration").hide(); }); });
    $("#send_password").on("click", function() { $("#authorization").slideDown(400, function() {$("#registration").hide(); }); });
    $("#leave_remind_password").on("click", function() { $("#authorization").show(); $("#remind_password").slideUp(); });
    $("#go_remind_password").on("click", function() { $("#remind_password").slideDown(400, function() {$("#authorization").hide(); }); });

    $("#order_options_rate").on("click", 'li',select_rate);
    $("#order_options_repairs").on("click", 'li', select_repairs);
    $("#order_options_type").on("click", 'li', select_type);

    $("#choose_rate").on("click","li", select_slider);

    $("#order_options_plus").on("click", come_dop_option);
    $("#order_options_right h5").on("click", come_dop_option);

    $(".check_box_out").on("click", function() {$(this).toggleClass("check_box_out check_box_in"); });
//
//    $(".combine").on("click", combine);
//    $(".uncombine").on("click", uncombine);



//    $("#add_room").on("click", function() {  $(this).parent().children('.smeta_room').eq(0).clone(true).insertBefore(this); });
//    $("#add_window").on("click", function() {$(this).parent().children('.smeta_window').eq(0).clone(true).insertBefore(this);
//                                               var count = $('.smeta_window').length;
//                                             $(this).parent().children('.smeta_window').eq(count-1).children('.smeta_count_window_right').hide();
//                                             $(this).parent().children('.smeta_window').eq(count-1).children('.smeta_count_window_left').hide();
//                                             $(this).parent().children('.smeta_window').eq(count-1).children('.ignore_window').hide();
//                                             $(this).parent().children('.smeta_window').eq(count-1).children('.smeta_text_header').remove();
//                                             $(this).parent().children('.smeta_window').eq(count-1).children('.choose_type_window').show();
//                                    } );
//
//    $("#add_door").on("click", function() {$(this).parent().children('.smeta_door').eq(0).clone(true).insertBefore(this);
//                                            var count = $('.smeta_door').length;
//                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_count_interior_door_right').hide();
//                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_count_interior_door_left').hide();
//                                            $(this).parent().children('.smeta_door').eq(count-1).children('.ignore_door').hide();
//                                            $(this).parent().children('.smeta_door').eq(count-1).children('.smeta_text_header').remove();
//                                            $(this).parent().children('.smeta_door').eq(count-1).children('.choose_type_door').show();
//    } );


//    $("#one_room").hover(function(){ $("#rooms").css("background-position", "0 -128px"); }, function(){ $("#rooms").css("background-position", "0 0"); }).on("click", on_smeta);
//    $("#two_room").hover(function(){ $("#rooms").css("background-position", "0 -256px") }, function(){ $("#rooms").css("background-position", "0 0"); }  ).on("click", on_smeta);
//    $("#three_room").hover(function(){ $("#rooms").css("background-position", "0 -384px") }, function(){ $("#rooms").css("background-position", "0 0"); }  ).on("click", on_smeta);
//    $("#four_room").hover(function(){ $("#rooms").css("background-position", "0 -512px") }, function(){ $("#rooms").css("background-position", "0 0"); }  ).on("click", on_smeta);
//    $("#five_room").hover(function(){ $("#rooms").css("background-position", "0 -640px") }, function(){ $("#rooms").css("background-position", "0 0"); }  ).on("click", on_smeta);

    $("#toggle_room").on("click", room_toggle);

    $(".last_calculations_form").on("click", function() { $("#last_calculations_pop-up").show(); });
    $(".last_calculations_pop-up_close").on("click", function() { $("#last_calculations_pop-up").hide(); });

    $(".smeta_count_window_one").on("click", window_choose);
    $(".smeta_count_window_two").on("click", window_choose);
    $(".smeta_count_window_three").on("click", window_choose);

    $(".smeta_count_interior_door_one").on("click", door_choose);
    $(".smeta_count_interior_door_two").on("click", door_choose);


    $(".selectbox2").selectbox({
        classHolder: 'sbHolder2',
        classSelector: 'sbSelector2',
        classOptions: 'sbOptions2'
        });

    $(".selectbox").selectbox();

    $(".slider_img").hover( function(){ $(".slider_about").show()  }, function() { $(".slider_about").hide() } );

    $("#rus_flag").on("click", function() { $("#uk_select").hide(); $("#rus_select").show();});
    $("#uk_flag").on("click", function() { $("#rus_select").hide(); $("#uk_select").show();});

    $(".ignore").on("click", function() {$(this).toggleClass("ignore ignored"); });
    $(".ignore_2").on("click", function() {$(this).toggleClass("ignore_2 ignored_2"); });
    $(".ignore_3").on("click", function() {$(this).toggleClass("ignore_3 ignored_3"); });
    $(".ignore_4").on("click", function() {$(this).toggleClass("ignore_4 ignored_4"); });
    $(".ignore_5").on("click", function() {$(this).toggleClass("ignore_5 ignored_5"); });


    $("#page_up").on("click", function(){ $.scrollTo(0, 0); });
    $("#top_right_stiker p").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )
    $("#top_right_stiker_rooms").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )
    $("#top_right_stiker_one_room").hover(function(){ $("#top_right_stiker_rooms").css("background-position", "35px -108px"); }, function(){ $("#top_right_stiker_rooms").css("background-position", "35px 20px"); }).on("click", on_smeta);
    $("#top_right_stiker_two_room").hover(function(){ $("#top_right_stiker_rooms").css("background-position", "35px -236px") }, function(){ $("#top_right_stiker_rooms").css("background-position", "35px 20px"); }  ).on("click", on_smeta);
    $("#top_right_stiker_three_room").hover(function(){ $("#top_right_stiker_rooms").css("background-position", "35px -364px") }, function(){ $("#top_right_stiker_rooms").css("background-position", "35px 20px"); }  ).on("click", on_smeta);
    $("#top_right_stiker_four_room").hover(function(){ $("#top_right_stiker_rooms").css("background-position", "35px -492px") }, function(){ $("#top_right_stiker_rooms").css("background-position", "35px 20px"); }  ).on("click", on_smeta);
    $("#top_right_stiker_five_room").hover(function(){ $("#top_right_stiker_rooms").css("background-position", "35px -620px") }, function(){ $("#top_right_stiker_rooms").css("background-position", "35px 20px"); }  ).on("click", on_smeta);


}).on("scroll", visible);



// открытие и скрытие дополнительных параметров
function come_dop_option() {
    $("#dop_options").slideToggle();
    $("#order_options_plus").toggleClass("minus plus");

}
// ---------------


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

// Дествие что происходит после выбора количества комнат
function on_smeta () {
    $("#top_right_stiker_rooms").hide();
    $("#top_right_stiker p").hide();
    $("#top_right_stiker").css("width", "155px");
    $("#top_right_stiker a").css("display", "block");
    $("#partners").hide();
    $("#be_partners").hide();
    $("#your_smeta").show();
    $("#your_price").show();
    $("#examples_works").slideUp();
    $("#last_calculations").slideUp("400", function () {
        $("#materials").slideDown();
        $("#repair_company").slideDown();
    });
//    setInterval( function(){$("#your_price_without_discount").fadeToggle(); }, 4000);
}
// --------------


// Выбор в меню тарифов, типа ремонта, типа квартиры
function select_rate () {
    $("#order_options_rate li").removeClass("selected");
    $(this).addClass("selected");
    var id = $(this).attr("id");
    $("#choose_rate li").removeClass("choose_rate_selected");
    if (id == 'order_options_rate_econom') {
        $("#choose_rate_econom").addClass('choose_rate_selected');
        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
        setTimeout(function(){ $("#examples_works_slider_econom").show(function() {$("#examples_works_slider_econom").children('div').fadeIn(); }); }, 500);
    }
    if (id == 'order_options_rate_standart') {
        $("#choose_rate_standart").addClass('choose_rate_selected');
        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
        setTimeout(function(){ $("#examples_works_slider_standart").show(function() {$("#examples_works_slider_standart").children('div').fadeIn(); }); }, 500);

    }
    if (id == 'order_options_rate_premium') {
        $("#choose_rate_premium").addClass('choose_rate_selected');
        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
        setTimeout(function(){ $("#examples_works_slider_premium").show(function() {$("#examples_works_slider_premium").children('div').fadeIn(); }); }, 500);
    }

}

function select_repairs () {
    $("#order_options_repairs li").removeClass("selected");
    $(this).addClass("selected");
}

function select_type () {
    $("#order_options_type li").removeClass("selected");
    $(this).addClass("selected");
}
// --------------


function select_slider() {
    $("#choose_rate li").removeClass("choose_rate_selected");
    $(this).addClass("choose_rate_selected");

    var id = $(this).attr("id");
    if (id == 'choose_rate_econom') {
        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
        setTimeout(function(){ $("#examples_works_slider_econom").show(function() {$("#examples_works_slider_econom").children('div').fadeIn(); }); }, 500);
    }
    if (id == 'choose_rate_standart') {
        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
        $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide() });
        setTimeout(function(){ $("#examples_works_slider_standart").show(function() {$("#examples_works_slider_standart").children('div').fadeIn(); }); }, 500);

    }
    if (id == 'choose_rate_premium') {
        $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
        $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
        setTimeout(function(){ $("#examples_works_slider_premium").show(function() {$("#examples_works_slider_premium").children('div').fadeIn(); }); }, 500);
    }
}



// сворот материалов комнаты
function room_toggle() {
    $(".materials_room_for_options").slideToggle();
    $(this).toggleClass("arrow_up arrow_down");
}
//--------------------


// выбор типа окна
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

}
//----------------------



// выбор типа двери
function door_choose() {
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

}
//----------------------



function authorization() {
    $("#overlap").show();
    $("#pop_up").show();
    $("#close_pop_up").show();
}

function close_authorization() {
    $("#overlap").hide();
    $("#pop_up").hide();
    $("#close_pop_up").hide();
}

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