function Smeta(){
    var _this = this;
    _this.types = new Array();
    _this.count_rooms = 0;
    _this.height_ceiling = 2.75;

    _this.init = function(){

        //-------выбор тарифа, ремонта и типа квартиры
        $("#order_options_rate").on("click", 'li',_this.select_rate);
        $("#order_options_repairs").on("click", 'li', _this.select_repairs);
        $("#order_options_type").on("click", 'li', _this.select_type);

        //-------выбор комнат у квартиры
        $("#rooms div").hover( function() { $("#rooms").css("background-position", "0 -" + _this.numb_bg(this) + "px"); },
            function() { $("#rooms").css("background-position", '0px -' + (128 * _this.count_rooms) + 'px'); }).on("click", _this.before_on_smeta);
        $("#top_right_stiker_rooms div").hover(
            function() {
                $("#top_right_stiker_rooms").css("background-position", "35px -" + (_this.numb_bg(this) - 20) + "px");
            },
            function() {
                $("#top_right_stiker_rooms").css("background-position", '35px -' + (128 * _this.count_rooms - 20) + 'px');
            }
        ).on("click", _this.before_on_smeta);
        $("#top_right_stiker p").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )
        $("#top_right_stiker_rooms").hover(function(){ $("#top_right_stiker_rooms").show(); }, function() {$("#top_right_stiker_rooms").hide();} )

        //кнопка добавления комнат
        $("#add_room").on("click", _this.add_room);

        // увеличение/уменьшение высоты потолока
        $("#plus_ceiling").on("click", function() { _this.select_ceiling(0) });
        $("#minus_ceiling").on("click", function() { _this.select_ceiling(1) });
        $('#input_ceiling').on('change', function() { _this.change_ceiling($(this).val()) });

        // кнопка добавления окна
        $("#add_window").on("click", function() { _this.add_window } );

        _this.setAllTypes(2,2,2);
       // console.log(_this);
    }

    // Выбор в меню тарифов, типа ремонта, типа квартиры
    _this.select_rate = function() {
        $("#order_options_rate li").removeClass("selected");
        $(this).addClass("selected");
        _this.setAllTypes($(this).index(),0,0);
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

    _this.select_repairs = function() {
        $("#order_options_repairs li").removeClass("selected");
        $(this).addClass("selected");
        _this.setAllTypes(0,$(this).index(),0);
    }

    _this.select_type = function() {
        $("#order_options_type li").removeClass("selected");
        $(this).addClass("selected");
        _this.setAllTypes(0,0,$(this).index());
    }

    _this.setAllTypes = function(rate, repair, apartment) {
        if (rate!=0) _this.types[0] = rate;
        if (repair!=0) _this.types[1] = repair;
        if (apartment!=0) _this.types[2] = apartment;
    }
    // --------------

    //добавление комнат
    _this.add_Rooms = function(numb) {
        _this.count_rooms = numb;
    }

    //выставить высоту потолка
    _this.set_Ceiling = function(numb) {
        _this.height_ceiling = numb;
    }

    //действие до on_smeta
    _this.before_on_smeta = function(){
        $("#rooms").css("background-position", '0px -' + _this.numb_bg(this) + 'px');
        _this.add_Rooms($(this).attr("data-numb"));
        var length = $('.smeta_room[data-room]').length;
        if(_this.count_rooms>length)
            for (var i=1; i<=_this.count_rooms-length; i++){
                $("#add_room").parent().children('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length);
            }
        if(_this.count_rooms<length)
            for (var i=length; i>_this.count_rooms; i--){
                $("#add_room").parent().children('.smeta_room[data-room='+i+']').remove();
            }
        _this.assign_numb();
        _this.on_smeta();
    }
    // Дествие что происходит после выбора количества комнат
    _this.on_smeta = function() {
        _this.set_Ceiling(parseFloat($('#input_ceiling').val()).toFixed(2));
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
        setInterval( function(){$("#your_price_without_discount").fadeToggle(); }, 4000);
    }
    // --------------
    //background выбранных комнат
    _this.numb_bg = function(object){
        var bp = 128 * parseInt($(object).attr("data-numb"));
        return bp;
    }
    //добавить комнату
    _this.add_room = function(){
        _this.add_Rooms($('.smeta_room[data-room]').length+1);
        $(this).parent().children('.smeta_room').eq(0).clone(true).insertBefore(this).attr('data-room', $('.smeta_room[data-room]').length);
        $("#rooms").css("background-position", '0px -' + (128 * _this.count_rooms) + 'px');
        _this.assign_numb();
        _this.on_smeta();
    }
    //расставить номера комнат
    _this.assign_numb = function(){
        if (_this.count_rooms>0){
            $(".smeta_room[data-room]").children('.smeta_room_text').children('.smeta_text_header').each(function(i) {
                $(this).html('комната №'+(i+1));
            });
        }
    }
    //выбор потолка
    _this.select_ceiling = function(type){
        if(type==0) var height = parseFloat($('#input_ceiling').val()) + 0.1 > 4 ? 4 : parseFloat($('#input_ceiling').val()) + 0.1;
        else var height = parseFloat($('#input_ceiling').val()) - 0.1 < 1.5 ? 1.5 : parseFloat($('#input_ceiling').val()) - 0.1;
        $('#input_ceiling').val(height.toFixed(2));
        _this.set_Ceiling(height.toFixed(2));
    }
    //занесение значения в поле потолка
    _this.change_ceiling = function(val){
        var height = 0;
        height = parseFloat(val) > 4 ? 4 : parseFloat(val);
        height = height < 1.5 ? 1.5 : height;
        $('#input_ceiling').val(parseFloat(height).toFixed(2));
        _this.set_Ceiling(parseFloat(height).toFixed(2));
    }
    //добавить окно
    _this.add_window = function(){
        $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore('#add_window').attr('data-window', $('.smeta_window[data-window]').length);
    }

}
$(document).ready(function () {
    var smeta = new Smeta();
    smeta.init();
});