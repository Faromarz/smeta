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
        $("#add_window").on("click", function() { _this.add_window() } );

        // увеличение/уменьшение количества окон
        $(".plus_window").on("click", function() { _this.plus_window(this) });
        $(".minus_window").on("click", function() { _this.minus_window(this) });
        $('.input_window').on('change', function() { _this.change_window(this) });

        // увеличение/уменьшение количества дверей
        $(".plus_door").on("click", function() { _this.plus_window(this) });
        $(".minus_door").on("click", function() { _this.minus_window(this) });
        $('.input_door').on('change', function() { _this.change_window(this) });

        //изменение площади комнаты при изменении ширины, длины
        $('.smeta_room_square_height_input').on('change', function() { _this.change_square_height(this) });
        $('.smeta_room_square_width_input').on('change', function() { _this.change_square_width(this) });

        //изменение ширины, высоты окон
        $('.window_width').on('change', function() { _this.change_window_width(this) });
        $('.window_height').on('change', function() { _this.change_window_height(this) });

        //изменение ширины, высоты дверей
        $('.door_width').on('change', function() { _this.change_door_width(this) });
        $('.door_height').on('change', function() { _this.change_door_height(this) });

        //кнопка добавления межкомнатных дверей
        $("#add_door").on("click", function() { _this.add_door() });

        _this.setAllTypes(2,2,2);
        _this.add_window();
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
                _this.add_window($('.smeta_room[data-room]').length+1);
                $("#add_room").parent().children('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length);
            }
        if(_this.count_rooms<length)
            for (var i=length; i>_this.count_rooms; i--){
                $("#add_room").parent().children('.smeta_room[data-room='+i+']').remove();
                $("#add_window").parent().children('.smeta_window[data-room='+i+']').remove();
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

    //background выбранных комнат
    _this.numb_bg = function(object){
        var bp = 128 * parseInt($(object).attr("data-numb"));
        return bp;
    }

    //добавить комнату
    _this.add_room = function(){
        if(parseInt(_this.count_rooms)+1<=5){
            _this.add_Rooms($('.smeta_room[data-room]').length+1);
            $(this).parent().children('.smeta_room').eq(0).clone(true).insertBefore(this).attr('data-room', $('.smeta_room[data-room]').length);
            $("#rooms").css("background-position", '0px -' + (128 * _this.count_rooms) + 'px');
            _this.assign_numb();
            _this.add_window();
            _this.on_smeta();
        }
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
    _this.add_window = function(n){
        var all_windows = $('.smeta_window[data-window]').length,
            max_windows = _this.count_rooms==0 ? 4: _this.count_rooms*1 + 3;
        if (all_windows<max_windows){
            if (typeof n === 'undefined')
            {
                var k = _this.count_rooms > all_windows-1 ? _this.count_rooms : 1;
            }
            else var k = parseInt(n);
            $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore('#add_window').attr('data-window', $('.smeta_window[data-window]').length).attr('data-room', k);
            $('.smeta_window[data-room='+k+']').children('.smeta_text_header').html('комната № ' + k);
        }
    }

    //плюс к количеству окон/дверей
    _this.plus_window = function(object){
        var input = $(object).prev(),
            count = parseInt($(input).val())+1 > 8 ? 8 : parseInt($(input).val())+1;
        $(input).val(count);
    }

    //минус от количества окон/дверей
    _this.minus_window = function(object){
        var input = $(object).next(),
            count = parseInt($(input).val())-1 < 0 ? 0 : parseInt($(input).val())-1;
        $(input).val(count);
    }

    //занесение значения в поле количества окон/дверей
    _this.change_window = function(object){
        var val = isNaN(parseInt($(object).val())) ? 0 : parseInt($(object).val()), count = 0;
        count = val > 8 ? 8 : val;
        count = count < 0 ? 0 : count;
        $(object).val(count);
    }

    //добавить межкомнатную дверь
    _this.add_door = function(){
        var count = $('.smeta_door[data-door]').length;
        if(count<3) $('#add_door').parent().children('.smeta_door').eq(0).clone('#add_door').insertBefore('#add_door').attr('data-door', $('.smeta_door[data-door]').length);
    }

    //изменение площади комнаты при изменении высоты
    _this.change_square_height = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val()), square = 0;
        $(object).val(parseFloat(val).toFixed(2));
        square = val * parseFloat($(object).parent().parent().children('.smeta_room_square_width').children('.smeta_room_square_width_input').val());
        $(object).parent().parent().children('.smeta_room_square_summ').children('#square-room').html(parseFloat(square).toFixed(2));
    }

    //изменение площади комнаты при изменении ширины
    _this.change_square_width = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val()), square = 0;
        $(object).val(parseFloat(val).toFixed(2));
        square = val * parseFloat($(object).parent().parent().children('.smeta_room_square_height').children('.smeta_room_square_height_input').val());
        $(object).parent().parent().children('.smeta_room_square_summ').children('#square-room').html(parseFloat(square).toFixed(2));
    }

    //изменение ширины окна
    _this.change_window_width = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val());
        val = val > 2.7 ? 2.7 : val;
        val = val < 0.4 ? 0.4 : val;
        if (val <= 1) {
            $(object).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "70px", "background-position" : "0 25px"});
        }
        if (val > 1 && val <1.8) {
            $(object).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "80px", "background-position" : "-79px 25px"});
        }
        if (val >= 1.8) {
            $(object).parent().parent().children('.smeta_count_window_left').children('.smeta_count_window_chosen').css({"width" : "120px", "background-position" : "-195px 25px"});
        }
        $(object).val(parseFloat(val).toFixed(2));
    }

    //изменение высоты окна
    _this.change_window_height = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val());
        val = val > 2.7 ? 2.7 : val;
        val = val < 0.4 ? 0.4 : val;
        $(object).val(parseFloat(val).toFixed(2));
    }

    //изменение ширины дверей
    _this.change_door_width = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val());
        val = val > 2 ? 2 : val;
        val = val < 0.6 ? 0.6 : val;
        $(object).val(parseFloat(val).toFixed(2));
    }

    //изменение высоты дверей
    _this.change_door_height = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val());
        val = val > 3 ? 3 : val;
        val = val < 0.4 ? 0.4 : val;
        $(object).val(parseFloat(val).toFixed(2));
    }

}
$(document).ready(function () {
    var smeta = new Smeta();
    smeta.init();
});