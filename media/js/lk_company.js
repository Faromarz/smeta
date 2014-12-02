$(document).ready(function () {

    $(".selectbox3").selectbox({
        classHolder: 'sbHolder3',
        classSelector: 'sbSelector3',
        classOptions: 'sbOptions3',
        classToggle: 'sbToggle3'
    });

    //функционал блока: персональная информация
    $("#lk-company-logo-for_logo").on("mouseenter", "#lk_company-logo", function() {   $(this).parent().children(".lk_company-logo-load").fadeIn(); }).on("mouseleave", ".lk_company-logo-load", function() { $(this).fadeOut(); } );
    $("#lk-content-personal_data").on("keypress", "textarea", function () { $("#lk_company-content-save_change").css("background", "#f7540f"); }).on("keypress", "input", function () {  $("#lk_company-content-save_change").css("background", "#f7540f"); }).on("click", ".flag", function() { $("#lk_company-content-save_change").css("background", "#f7540f"); } );
    $("#lk_company-content-save_change").on("click", function() {$(this).css("background", "#84909a" ); });



    //функционал блоков: работники
    $("#lk_company-worker").on("mouseenter", ".lk_company-worker-block-photo", function() {   $(this).parent().children(".lk_company-worker-block-photo_load").fadeIn(); }).on("mouseleave", ".lk_company-worker-block-photo_load", function() { $(this).fadeOut(); }).on("click", ".lk_company-worker-block_close", function() { $(this).parent(".lk_company-worker-for_block").remove(); }).on("keypress", "input", function () { $(this).parent().children('.lk_company-worker-block-save_change').css("background", "#f7540f"); }).on("keypress", "textarea", function () { $(this).parent().children('.lk_company-worker-block-save_change').css("background", "#f7540f"); }).on("click", ".lk_company-worker-block-save_change", function() { $(this).css("background", "#84909a"); });




    //функционал блоков: примеры работ
    $("#lk_company-examples_works").on("mouseenter", ".lk_company-examples_works-block", function() { $(this).children(".lk_company-examples_works-block-change").fadeIn(); }).on("mouseleave", ".lk_company-examples_works-block", function() { $(this).children(".lk_company-examples_works-block-change").fadeOut(); }).on("click", ".lk_company-examples_works-block", change_photo  );
    $("#lk_company-close_pop_up").on("click", close_change_photo);


    //сворот/разворот в прайс-листе
    $("#lk_company-price").on("click", ".lk_company-price-block-header", function(){ $(this).toggleClass('lk_company-price-block-header-up lk_company-price-block-header-down').parent().children('ul').slideToggle();
                                                                                    var per = $(this).children('h2').text();
                                                                                    if (per == 'Демонтажные работы') {$("#dismantling").parent('.lk_company-price-for_save_change').fadeToggle(); }
                                                                                    else {$("#installation").parent('.lk_company-price-for_save_change').fadeToggle(); }    } );

});



function change_photo(){
    $("#overlap").show();
    $("#lk_company-pop_up").show();
    $("#lk_company-close_pop_up").show();
}

function close_change_photo() {
    $("#overlap").hide();
    $("#lk_company-pop_up").hide();
    $("#lk_company-close_pop_up").hide();
}