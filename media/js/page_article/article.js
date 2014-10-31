var top_block;
var height_menu;
var top_menu;
//var menu = $("#text-menu");

$(document).ready(function () {


    top_block = $("#text-header3").offset().top;
    top_menu = $("#text-menu").offset().top;
    height_menu = $("#text-menu").height();

    $("#text-menu").on("click", ".text-menu-non_selected", select_item).on("click", ".text-menu_second-non_selected", select_item_second);

    $("#rooms").on("click", "#one_room", calculate).on("click", "#two_room", calculate).on("click", "#three_room", calculate).on("click", "#four_room", calculate).on("click", "#five_room", calculate);

}).on("scroll", freeze_menu);

function select_item(){
    $('.text-menu-non_selected').removeClass('text-menu-selected');
    $('.text-menu-item ul').slideUp(400, function (){height_menu = $("#text-menu").height();} );
    $(this).addClass('text-menu-selected').parent().children('ul').slideDown(400, function (){height_menu = $("#text-menu").height();} );

}

function select_item_second(){
    $(".text-menu_second-non_selected").removeClass("text-menu_second-selected");
    $(this).addClass('text-menu_second-selected');
}

function calculate() {
    $("#text-for_calculate").slideDown();
}

function freeze_menu() {


    var scroll_window = $(this).scrollTop();

    if (scroll_window < top_menu - 10) {
        $("#text-menu").css({ "position" : "relative", "top": "80px" });
    }


    if ((scroll_window > top_menu - 10) && (scroll_window < top_block - height_menu - 70) ) {
        $("#text-menu").css({ "position" : "fixed", "top": "10px"});
    }

    if(scroll_window > top_block - height_menu - 70) {
        $("#text-menu").css({ "position" : "relative", "top": 80 + top_block - (top_menu+height_menu) - 60  });
    }
}