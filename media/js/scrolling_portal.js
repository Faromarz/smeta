var scroll = 0;
var count_face;

$(document).ready(function () {
    count_face = $(".face_block_conteyner").length;

    $("#our_face-for_scrolling-inner_unit").css("width", (count_face * 310)-10 );

    $("#our_face-for_scrolling-external_unit").mCustomScrollbar({
        horizontalScroll:true,
        mouseWheel: false
    });

    $("#our_face-for_scrolling-external_unit").mCustomScrollbar("scrollTo", 0);

    $("#our_face-for_scrolling-right_arrow").click(function(right){

        scroll = mcs.left - 310;
        $("#our_face-for_scrolling-external_unit").mCustomScrollbar("scrollTo", -scroll);

    });

    $("#our_face-for_scrolling-left_arrow").click(function(left){
        scroll = mcs.left + 310;
        $("#our_face-for_scrolling-external_unit").mCustomScrollbar("scrollTo", -scroll);
    });
});