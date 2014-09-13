var interval = null;
var scroll = 0;
var count_firm;
var mail_top;

$(document).ready(function () {

    $("#budget-content_bottom-center").on("click", "a", authorization);

    mail_top = $("#mail").offset().top;
    $("#add_room").on("click", function(){ mail_top = $("#mail").offset().top;} );
    $("#add_window").on("click", function() {mail_top = $("#mail").offset().top; });
    $("#add_door").on("click", function() {mail_top = $("#mail").offset().top;});



    $("#change_budget").on("click", function(){$("#budget_dop_options").slideDown(350); $("#budget_dop_options-hide").fadeIn(400, function() {  mail_top = $("#mail").offset().top;}); });
    $("#budget_dop_options-hide").on("click", function(){$("#budget_dop_options").slideUp(350); $("#budget_dop_options-hide").fadeOut(400, function() {mail_top = $("#mail").offset().top;});} )

    $(".budget_basic_options").on("click",".budget_basic_options_job", on_input).on("blur", "input", off_input).on("keyup", "input", function (event){ if (event.keyCode == 13) { off_input.call(this); } } );
    $(".slide1").on("click", function() { $(this).parent().children('ul').slideToggle(); $(this).toggleClass('budget_basic_options_name_style1_down budget_basic_options_name_style1_up'); });
    $(".slide2").on("click", function() { $(this).parent().children('ul').slideToggle(); $(this).toggleClass('budget_basic_options_name_style2_down budget_basic_options_name_style2_up'); });

    $("#budget_repair_estimate-bottom").on("click", "p", slide_menu );

    var firm = $(".firm");
    count_firm = firm.length;

    if (count_firm <4) {
        $("#budget_repair_estimate-scrolling-left_arrow").hide();
        $("#budget_repair_estimate-scrolling-right_arrow").hide();
        $(".budget_repair_estimate-scrolling-external_unit").css("margin-left", '95px');
    }

    $(".budget_repair_estimate-scrolling-inner_unit").css("width", (count_firm * 322)-2 );


    $(".budget_repair_estimate-scrolling-external_unit").mCustomScrollbar({
        horizontalScroll:true

    });

    $(".budget_repair_estimate-scrolling-external_unit").mCustomScrollbar("scrollTo", 0);

    $("#budget_repair_estimate-scrolling-right_arrow").click(function(right){

        scroll = mcs.left - 300;
        $(".budget_repair_estimate-scrolling-external_unit").mCustomScrollbar("scrollTo", -scroll);

    });

    $("#budget_repair_estimate-scrolling-left_arrow").click(function(left){
        scroll = mcs.left + 300;
        $(".budget_repair_estimate-scrolling-external_unit").mCustomScrollbar("scrollTo", -scroll);
    });


    firm.hover(function() { $(this).children(".firm_conteyner").css("margin-top", "-170px"); }, function(){ $(this).children(".firm_conteyner").css("margin-top", "0"); }).on("click", function() { firm.removeClass('firm_selected'); $(this).addClass("firm_selected"); });

}).on("scroll", fixed);

function on_input() {
    var val = $(this).children('h3').text();
    $(this).children('h3').hide();
    $(this).children('h6').hide();
    $(this).children('input').val(val).show().focus();

}

function off_input() {

    var val = $(this).val();
    $(this).hide();
    var check_val = +val;

    if (isNaN(check_val)) {
        $(this).parent().children('h3').show();
        $(this).parent().children('h6').show();
    }
    else {
        $(this).parent().children('h3').text(val).show();
        $(this).parent().children('h6').show();
    }

}

function slide_menu() {

    var count = 1;
    $(this).toggleClass("budget_repair_estimate-bottom-arrow_down budget_repair_estimate-bottom-arrow_up");
    var slide_menu = $("#budget_repair_estimate-slide_menu");
    slide_menu.slideToggle(400, function(){


        if (slide_menu.is(':visible')) {

            interval = setInterval( function(){
                switch (count) {
                    case 1:  $(".budget_repair_estimate-slide_menu-slide1").fadeOut(400, function () {$(".budget_repair_estimate-slide_menu-slide2").fadeIn(); } );
                        count = 2;
                        break;
                    case 2: $(".budget_repair_estimate-slide_menu-slide2").fadeOut(400, function () {$(".budget_repair_estimate-slide_menu-slide3").fadeIn(); } );
                        count = 3;
                        break;
                    case 3: $(".budget_repair_estimate-slide_menu-slide3").fadeOut(400, function () {$(".budget_repair_estimate-slide_menu-slide1").fadeIn(); } );
                        count =1;
                        break;
                }  }, 3000);

        }

        else{
            clearInterval(interval);
            $(".budget_repair_estimate-slide_menu-slide3").hide();
            $(".budget_repair_estimate-slide_menu-slide2").hide();
            $(".budget_repair_estimate-slide_menu-slide1").show();
        }
    });
}

function fixed(){

    var scroll_window = $(this).scrollTop();
    if (scroll_window - mail_top < 0) {
        $("#mail").css({"position": "static", "margin-left": "232px"});
    }
    else {
        $("#mail").css({"position": "fixed", "top": "0", "left": "50%", "margin-left": "117px"});
    }
}