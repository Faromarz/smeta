function Smeta(){
    var _this = this;
    _this.types = new Array();
    _this.categories_materials_materials = new Array();
    _this.materials = new Array();
    _this.rooms = new Array();
    _this.categories_works = new Array();
    _this.works = new Array();
    _this.count_rooms = 0;
    _this.height_ceiling = 2.75;
    _this.size = 0;
    _this.price_materials = 0;
    _this.price_works_dem = 0;
    _this.price_works_mon = 0;
    _this.time_works_dem = 0;
    _this.time_works_mon = 0;
    _this.room_name = '';
    
    _this.getHeight = function(){
        return Number(_this.height_ceiling);
    };
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

        //расставление типов
        _this.setAllTypes(2,2,2);
        //добавление окон
        _this.add_window();

        //загрузка комнат
        _this.load_rooms();

        //загрузка категорий материалов
        _this.load_categories();

        //загрузка категорий работ
        _this.load_categories_works();
        //загрузка работ
        _this.load_works();

        // вкл/выкл учитывания комнаты
        $(".ignore").on("click", function() { _this.on_off_room(this); });
        $(".ignore_4[data-room-id='1']").on("click", function() { _this.on_off_room(this, 1); });

        //кнопка перехода на смету клиента
        $("#your_smeta").on("click", function() { _this.add_smeta() });
    };

    //добавление сметы в бд
    _this.add_smeta=function(){
        _this.preloader(true);
        var rooms;
         $.each(_this.rooms, function(key, room) {
             rooms.push(room.getParams());
         });
        $.ajax({
            type: "POST",
            url: "ajax/smeta/add",
            data: { "rooms" : JSON.stringify(rooms), "types" : _this.types, "size" : _this.size, "height" : _this.height_ceiling,
                    "price_materials" : _this.price_materials, "price_work_dem": _this.price_works_dem, "price_work_mon": _this.price_works_mon,
                    "time_work_dem": _this.time_works_dem, "time_work_mon": _this.time_works_mon, "room_name" : _this.room_name, "count_rooms" : _this.count_rooms},
            success: function(data){
                var result = JSON.parse( data );
                window.location.href = "budget/"+result[0]['smeta_name'];
            }
        }, 'json');
        _this.preloader(false);
    };

    // вкл/выкл учитывания комнаты
    _this.on_off_room = function(object, flag) {
        if (flag===undefined){
            $(object).toggleClass("ignore ignored");
            var id = $(object).parent().attr("data-room-id");
            if (id==1) $(".ignore_4[data-room-id='1'], .ignored_4[data-room-id='1']").toggleClass("ignore_4 ignored_4");
        }else {
            var id=1;
            $(".smeta_room[data-room-id='"+id+"']").find('div.ignore, div.ignored').toggleClass("ignore ignored");
            $(object).toggleClass("ignore_4 ignored_4");
        }
        $.each(_this.rooms, function(key, room) {
            if(room.getId() === id) {
                _this.rooms[room_key]['show'] = _this.rooms[room_key]['show'] ? 0 : 1;
                if(id===1) {
                    $.each(_this.rooms[room_key]['materials'], function(key, val) {
                        _this.rooms[room_key]['materials'][key]['show'] = _this.rooms[room_key]['materials'][key]['show']? 0 : 1;
                    });
                }
            }
        });
        _this.get_rooms_paint(1);
    };

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
        _this.add_to_rooms();
    }

    _this.select_repairs = function() {
        $("#order_options_repairs li").removeClass("selected");
        $(this).addClass("selected");
        _this.setAllTypes(0,$(this).index(),0);
        _this.add_to_rooms();
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
                $("#add_room").siblings('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length).attr('data-room-id', $('.smeta_room[data-room]').length);
            }
        if(_this.count_rooms<length)
            for (var i=length; i>_this.count_rooms; i--){
                $("#add_room").siblings('.smeta_room[data-room='+i+']').remove();
                $("#add_window").siblings('.smeta_window[data-room='+i+']').remove();
            }
        var count_r=1;
        $.each(_this.rooms, function(key, room) {
            if(room.getType() === 1){
                room.setShow(_this.count_rooms >= count_r);
                count_r++;
            }
        });
        _this.assign_numb();
        _this.on_smeta();
    };

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
        _this.calculation_works();
        var text_room = '';
        if (_this.count_rooms===1) text_room = 'однокомнатная квартира';
        else
        if (_this.count_rooms===2) text_room = 'двухкомнатная квартира';
        else
        if (_this.count_rooms===3) text_room = 'трехкомнатная квартира';
        else
        if (_this.count_rooms===4) text_room = 'четырехкомнатная квартира';
        else
        if (_this.count_rooms===5) text_room = 'пятикомнатная квартира';
        $('#dop_options_footer_rezult').find('h1:eq(0)').text(text_room);
        _this.room_name = text_room;
        _this.calculation_square();
    };

    //расчитать площадь квартиры
    _this.calculation_square = function(){
        var square = 0;
        $.each(_this.rooms, function(key, room) {
            if(room.getShow()) {
                square += room.getSize();
            }
        });
        _this.size = square;
        $('#dop_options_footer_rezult').find('h3:eq(0)').text(square);
    };

    //background выбранных комнат
    _this.numb_bg = function(object){
        var bp = 128 * parseInt($(object).attr("data-numb"));
        return bp;
    };

    //добавить комнату
    _this.add_room = function(){
        if(parseInt(_this.count_rooms)+1<=5){
            _this.add_Rooms($('.smeta_room[data-room]').length+1);
            $(this).siblings('.smeta_room').eq(0).clone(true).insertBefore(this).attr('data-room', $('.smeta_room[data-room]').length).attr('data-room-id', $('.smeta_room[data-room]').length);
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
            max_windows = _this.count_rooms===0 ? 4: _this.count_rooms*1 + 3;
        if (all_windows<max_windows){
            if (typeof n === 'undefined')
            {
                var k = _this.count_rooms > all_windows-1 ? _this.count_rooms : 1;
            }
            else var k = parseInt(n);
            $('#add_window').siblings('.smeta_window').eq(0).clone(true).insertBefore('#add_window').attr('data-window', $('.smeta_window[data-window]').length).attr('data-room', k);
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
        if(count<3) $('#add_door').siblings('.smeta_door').eq(0).clone('#add_door').insertBefore('#add_door').attr('data-door', $('.smeta_door[data-door]').length);
    }

    //изменение площади комнаты при изменении высоты
    _this.change_square_height = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val()), square = 0;
        $(object).val(parseFloat(val).toFixed(2));
        square = val * parseFloat($(object).parent().siblings('.smeta_room_square_width').children('.smeta_room_square_width_input').val());
        $(object).parent().siblings('.smeta_room_square_summ').children('#square-room').html(parseFloat(square).toFixed(2));

        var id = $(object).parent().parent().parent().attr("data-room-id");
        $.each(_this.rooms, function(key, room) {
            if(room.getId() === id) {
                room.setLength(val);
            }
        });
        _this.calculation_square();
    };

    //изменение площади комнаты при изменении ширины
    _this.change_square_width = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val()), square = 0;
        $(object).val(parseFloat(val).toFixed(2));
        square = val * parseFloat($(object).parent().siblings('.smeta_room_square_height').children('.smeta_room_square_height_input').val());
        $(object).parent().siblings('.smeta_room_square_summ').children('#square-room').html(parseFloat(square).toFixed(2));

        var id = $(object).parent().parent().parent().attr("data-room-id");
        $.each(_this.rooms, function(key, room) {
            if(room.getId() === id) {
                room.setWidth(val);
            }
        });
        _this.calculation_square();
    };

    //изменение ширины окна
    _this.change_window_width = function(object){
        var val = isNaN(parseFloat($(object).val())) ? 0 : parseFloat($(object).val());
        val = val > 2.7 ? 2.7 : val;
        val = val < 0.4 ? 0.4 : val;
        var self = $(object).parent().siblings('.smeta_count_window_left').children('.smeta_count_window_chosen');
        if (val <= 1) {
            self.css({"width" : "70px", "background-position" : "0 25px"});
        }
        if (val > 1 && val <1.8) {
            self.css({"width" : "80px", "background-position" : "-79px 25px"});
        }
        if (val >= 1.8) {
            self.css({"width" : "120px", "background-position" : "-195px 25px"});
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


    //загрузка комнат
    _this.load_rooms = function(){
        $.ajax({
            type: "POST",
            url: "ajax/rooms/load_rooms",
            success: function(data){
                var result=JSON.parse( data );
                $.each(result, function(key, room) {
                    _this.rooms.push(new Room(_this, room));
                });
                console.log(_this.rooms);
            }
        }, 'json');
    };

    //загрузка категорий материалов
    _this.load_categories = function(){
        _this.preloader(true);
        $.ajax({
            type: "POST",
            url: "ajax/materials/load_categories",
            success: function(data){
                var result = JSON.parse( data );
                _this.categories_materials = $.extend(true, [], result);
                _this.load_materials();
            }
        }, 'json');
    }

    //загрузка материалов для категории
    _this.load_materials = function(){
        $.ajax({
            type: "POST",
            url: "ajax/materials/load_materials",
            success: function(data){
                var result=JSON.parse( data );
                _this.materials = $.extend(true, [], result);
                _this.add_to_rooms();
            }
        }, 'json');
    }

    //загрузка категорий работ
    _this.load_categories_works = function(){
        $.ajax({
            type: "POST",
            url: "ajax/works/load_categories_works",
            success: function(data){
                var result=JSON.parse( data );
                _this.categories_works = $.extend(true, [], result);
            }
        }, 'json');
    }

    //загрузка работ
    _this.load_works = function(){
        $.ajax({
            type: "POST",
            url: "ajax/works/load_works",
            success: function(data){
                var result=JSON.parse( data );
                _this.works = $.extend(true, [], result);
            }
        }, 'json');
    };

    //расчет работ
    _this.calculation_works = function(){
        var summa = 0, dem_sum = 0, dem_time = 0, mont_sum = 0, mont_time = 0, select_repair = _this.types[1]+'_'+_this.types[0], for_repair=[],for_types=[],mat_cat_ids=[],all_works=new Array();
        $.each(_this.works, function(work_key, work) {
            if (Number(work.types_apartment_ids) === _this.types[2]) {
                for_repair = work.repair_ids.split(',');
                mat_cat_ids = work.cat_arr===null?1:work.cat_arr.split(',');
                $.each(_this.rooms, function(room_key, room) {
                    if(room.getShow()){
                        for_types = work.room_type === null ? 1 : work.room_type.split(',');
                        if(($.inArray(select_repair,  for_repair) !== -1 || work.repair_ids === null) && ($.inArray(''+room.getType(), for_types) !== -1 || work.room_type === null)) {
                            $.each(room.materials, function(material_key, material) {
                                if(material.show){
                                    if($.inArray(material.under_id === 0 ? material.cat_id : material.under_id, mat_cat_ids) !== -1 || work.cat_arr === null){
                                            var count = work.count;
                                            var new_count = '';
                                            if (count.indexOf('S') + 1) {
                                                new_count = count.replace("S", "Number(room.getSize())");
                                            } else if (count.indexOf('CD') + 1) {
                                                new_count = count.replace("CD", "Number($('.smeta_door[data-door]').length)");
                                            } else if (count.indexOf('CW') + 1) {
                                                new_count = count.replace("CW", "Number($('.smeta_window[data-window]').length)");
                                            } else if (count.indexOf('C') + 1) {
                                                new_count = count.replace("C", "Number(_this.count_rooms)");
                                            } else if (count.indexOf('PW') + 1) {
                                                new_count = count.replace("PW", "Number(room.getSizeWall())");
                                            } else if (count.indexOf('P') + 1) {
                                                new_count = count.replace("P", "Number(room.getPerimeter())");
                                            } else {
                                                new_count = count;
                                            }
                                            _this.getCount = eval("(function(){return " + new_count + ";})");
                                            _this.count = _this.getCount();
                                            if (_this.count === undefined) {
                                                _this.count = 1;
                                            } else if ( work.price === undefined) {
                                            }
                                            summa += parseFloat(work.price) * parseFloat(_this.count);
                                            if(work.type === 0){
                                                dem_sum+=parseFloat(work.price) * parseFloat(_this.count);
                                                dem_time+=parseFloat(work.watch);
                                            }else{
                                                mont_sum+=parseFloat(work.price) * parseFloat(_this.count);
                                                mont_time+=parseFloat(work.watch);
                                            }
                                            all_works.push({ 'work_id' : work.id, 'room_id' : room.getId(), 'room_type' : room.getType(),
                                                'price' : parseFloat(work.price) * parseFloat(_this.count), 'count' : parseFloat(_this.count)});
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
        _this.add_to_works(all_works);
        $('#your_price_without_discount').find('h2:eq(1)').text(parseFloat(summa).toFixed(2) + '  р');
        $('#demont_works').find('h1:eq(0)').text(parseFloat(dem_time).toFixed(2) + '  часов');
        $('#demont_works').find('h1:eq(1)').text(parseFloat(dem_sum).toFixed(2) + '  р');
        $('#mont_works').find('h1:eq(0)').text(parseFloat(mont_time).toFixed(2) + '  часов');
        $('#mont_works').find('h1:eq(1)').text(parseFloat(mont_sum).toFixed(2) + '  р');
        _this.price_works_dem = parseFloat(dem_sum).toFixed(2);
        _this.price_works_mon = parseFloat(mont_sum).toFixed(2);
        _this.time_works_dem = parseFloat(dem_time).toFixed(2);
        _this.time_works_mon = parseFloat(mont_time).toFixed(2);
    };

    //добавление работ в комнаты
    _this.add_to_works = function(masive){
        var in_array = new Array();
        $.each(_this.rooms, function(key, room) {
            room.works = new Array();
            in_array.length = 0;
            $.each(masive, function(key, val) {
                if(val.room_id === room.getId() && $.inArray(val.work_id,in_array) === -1){
                    in_array.push(val.work_id);
                    room.works.push({ 'work_id' : val.work_id, 'price': val.price, 'count' : val.count});
                }
            });
        });
    };

    //добавление материалов в комнаты
    _this.add_to_rooms = function(){
        var select_repair = _this.types[1]+'_'+_this.types[0],
            summ_materials = 0;
        $.each(_this.rooms, function(room_key, room) {
            room.materials = new Array();
            $.each(_this.categories_materials, function(k, v) {
                var for_repair = v.repair_id_rate_id.split(','),
                    for_types = v.rooms_type.split(',');
                if(($.inArray(select_repair,for_repair)!== -1 || v.repair_id_rate_id===null) && ($.inArray(''+room.getType(),for_types)!== -1)){
                    var ide = v.id;
                    var under_id = 0;
                    if (v.under.length >0){
                        $.each(v.under, function(key, val) {
                            var for_repair = val.repair_id_rate_id.split(','),
                                for_types = val.rooms_type.split(',');
                            if(($.inArray(select_repair,for_repair)!== -1 || val.repair_id_rate_id===null) && ($.inArray(''+room.getType(),for_types)!== -1))
                            {
                                if(val.selected===1) {
                                    ide = val.id;
                                    under_id = val.id;
                                }
                            }
                        });
                    }
                    summ_materials += parseFloat(_this.count_material(v.calculation,room_key))*parseFloat(_this.get_selected_material(ide).price);
                    room.materials.push({ 'cat_id' : v.id, 'under_id' : under_id, 'mat_id' : _this.get_selected_material(ide).id, 'show' : true, 'calc' : v.calculation });
                }
            });
        });
        $('#your_price_without_discount').find('h2:eq(0)').text(parseFloat(summ_materials).toFixed(2) + '  р');
        $('#materials_summ').find('h1:eq(0)').text(parseFloat(summ_materials).toFixed(2) + '  р');
        _this.price_materials = parseFloat(summ_materials).toFixed(2);
        _this.get_rooms_paint(1);
    };

    //выбранный материал
    _this.get_selected_material = function(cat_id){
        var result= new Array();
        $.each(_this.materials, function(key, val) {
            if(val.category_id === cat_id && val.selected)
                result = $.extend(true, [], _this.materials[key]);
        });
        return result;
    };

    //выбранный материал для комнат
    _this.get_selected_material_room = function(cat_id,numb){
        var mat_id= 0, under_id = 0;
        $.each(_this.rooms[numb]['materials'], function(key, material) {
            if (material.cat_id===cat_id) {
                mat_id = material.mat_id;
                under_id = material.under_id;
            }
        });
        var result= new Array();
        $.each(_this.materials, function(key, val) {
            if((val.category_id===cat_id || val.category_id===under_id) && val.id===mat_id)
                result = $.extend(true, [], _this.materials[key]);
        });
        return result;
    };

    //ключ выбранного материала
    _this.get_key_material = function(id){
        var result = 0;
        $.each(_this.materials, function(key, val) {
            if(val.id===id)
                result = key;
        });
        return result;
    };

    //show материала
    _this.get_show_material = function(id,room){
        var result = 0;
        $.each(_this.rooms[room]['materials'], function(key, material) {
            if (material.mat_id===id) {
                result = material.show;
            }
        });
        return result;
    };

    //количество материала у категории
    _this.get_min_material = function(cat_id){
        var result = 10000;
        $.each(_this.materials, function(key, val) {
            if(val.category_id==cat_id)
                if (result>key) result = key;
        });
        return result;
    }

    //количество материала у категории
    _this.get_max_material = function(cat_id){
        var result = 0;
        $.each(_this.materials, function(key, val) {
            if(val.category_id==cat_id)
            if (result<key) result = key;
        });
        return result;
    }

    //количество материала у категории
    _this.get_materials_slider = function(k){
        var result= new Array();
        $.each(_this.materials, function(key, val) {
            if(key==k)
                result = $.extend(true, [], _this.materials[key]);
        });
        return result;
    }

    //функция к отрисовке материалов в комнатах, параметр numb-количество комнат
    _this.get_rooms_paint = function(numb){
        var i=1;
        $.each(_this.rooms, function(key, room) {
            if (i<=numb) _this.paint_materials(key);
            i++;
        });
    }

    //отрисовка материалов всех - по категориям
    _this.paint_materials = function(numb){
        var rooms_cat_parents = new Array(),
            rooms_cat_under = new Array(),
            rooms_material = new Array();
        $.each(_this.rooms[numb]['materials'], function(key, material) {
            rooms_cat_parents.push(material.cat_id);
            rooms_cat_under.push(material.under_id);
            rooms_material.push(material.mat_id);
        });
        var text = '';
            $.each(_this.categories_materials, function(k, v) {
                if ($.inArray(v.id,rooms_cat_parents)!== -1){
                    var ide = v.id, calc = v.calculation;
                    var selected = _this.get_selected_material_room(v.id,numb),
                        selected_key = _this.get_key_material(selected.id),
                        ignored = _this.get_show_material(selected.id,numb) ? 'ignore_4' : 'ignored_4';
                    text += '<div class="materials_room_option" id="category-'+ide+'">' +
                        '<div class="materials_room_option_header">' +
                        '<p>'+ v.name+'</p>' +
                        '<div class="'+ignored+'" data-mat="'+selected.id+'"></div>' +
                        '</div>';
                    if (v.under.length >0){
                        text += '<select class="selectbox" id="val-'+v.id+'" >';
                        $.each(v.under, function(key, val) {
                                var select_option = '';
                            if($.inArray(val.id,rooms_cat_under)!== -1) {
                                select_option = 'selected = "selected"';
                                ide = val.id;
                                calc = val.calculation;
                            }
                            text += '<option value="'+val.id+'" '+select_option+'>'+val.name+'</option>';
                        });
                        text += '</select>';
                    } else text += '<div class="materials_room_option_menu"></div>';

                    var min_material = _this.get_min_material(ide),
                        max_material = _this.get_max_material(ide),
                        count_material = _this.count_material(calc,numb),
                        words = selected.count_text.split(',');

                    text += '<div class="materials_room_option_slider" id="material-slider-'+ide+'">' +
                        '       <div class="slider-materials-' + ide + '" style="position: relative">'+
                        '           <div class="ui-slider-handle ui-state-default ui-corner-all"><h6 class="slider_price price-materials-' + ide + '">' + selected.price + ' р</h6></div>'+
                        '       </div>'+
                        '     <div class="slider_img" style="background-image: url(/media/img/material/' + selected.img + ')"' + '>'+
                        '    <div class="slider_about">'+
                        '        <a href="#" class="mat-name-' + ide + '">' + selected.name + '</a>'+
                        '          <h6 class="city-name-' + ide + '">' + selected.country + '</h6>'+
                        '    </div>'+
                        '    </div>'+
                        '</div>' +
                        '<div class="x"></div>' +
                        '<h1>'+count_material+' '+_this.declination(words[2], words[0], words[1], count_material)+' =</h1>' +
                        '<h2 class="mat-price-all-' + ide + '">'+(parseFloat(count_material)*parseFloat(selected.price))+' р.</h2>' +

                        '<script>'+
                        "$('.slider-materials-" + ide + "').slider({"+
                        "min: " + min_material + ","+
                        "orientation : 'vertical',"+
                        "value: " + selected_key + ","+
                        'max: '+ max_material +','+
                        "step: 1,"+
                        "create: function () {"+
                        "},"+
                        "slide: function (e, ul) { "+
                        '   $(".price-materials-' + ide + '").text(smeta.get_materials_slider(ul.value).price+" р");'+
                        '   $(".mat-price-all-' + ide + '").text((smeta.get_materials_slider(ul.value).price+" р"));'+
                        '   $(".mat-name-' + ide + '").text(smeta.get_materials_slider(ul.value).name);'+
                        '   $(".city-name-' + ide + '").text(smeta.get_materials_slider(ul.value).country);'+
                        '   $("#material-slider-' + ide + '").find(".slider_img").css( "background-image","url(/media/img/material/"+smeta.get_materials_slider(ul.value).img+")");'+
                        "},"+
                        "stop : function (e, ul) {"+
                        "   smeta.select_material(ul.value, "+ v.id+", "+numb+");"+
                        "},"+
                        "});"+
                        '</script>'
                        +'</div>';
                }
            });
        $('.materials_room_for_options').empty();
        $('.materials_room_for_options').html(text);
        $(".selectbox").selectbox({
            onChange: function (val, inst) {
                _this.select_new_category(this, val, numb);
            }
        });
        $(".slider_img")
            .mouseenter(function() {
                $(this).children(".slider_about").show();
            })
            .mouseleave(function() {
                $(this).children(".slider_about").hide();
            });
        _this.preloader(false);
    };

    //выбор из селекта типов материалов
    _this.select_new_category = function(object, value, numb){
        var id_select = $( object ).attr('id'),
            a = id_select.split('-'),
            ide = a[1];
        $.each(_this.rooms[numb]['materials'], function(key, material) {
            if(material.cat_id===ide) {
                _this.rooms[numb]['materials'][key]['under_id']=value;
                $.each(_this.materials, function(_key, val) {
                    if(val.category_id===value)
                    if(val.selected===1) _this.rooms[numb]['materials'][key]['mat_id'] = val.id;
                });
            }
        });
        _this.get_rooms_paint(1);
    };

    //выбор материала в ползунке
    _this.select_material = function(value, cat_id, numb){
        var mat_id=0;
        $.each(_this.materials, function(key, val) {
            if(value==key) mat_id = val.id;
        });
        $.each(_this.rooms[numb]['materials'], function(key, material) {
            if(material.cat_id===cat_id) _this.rooms[numb]['materials'][key]['mat_id']=mat_id;
        });
    };

    //гифка прелоадера
    _this.preloader = function(status){
        if(status){
            $('body').append('<img src="/media/img/ajax-loader.gif" id="ajaxLoad">');
            $.fancybox.open({
                href: '#ajaxLoad',
                padding:0,
                maxWidth: 180,
                maxHeight: 50,
                minWidth: 180,
                minHeight: 50,
                scrolling: 'no',
                closeBtn: false,
                helpers   : {
                    overlay:
                    {
                        css: { 'background': 'rgba(255 , 255 , 250, 0.5)' },
                        closeClick: false
                    }
                }
            });
        }else{
            $.fancybox.close();
            $('body #ajaxLoad').remove();
        }
    };

    //склонение слов
    _this.declination = function(a, b, c, s) {
        var words = [a, b, c];
        var index = s % 100;

        if (index >=11 && index <= 14) { index = 0; }
        else { index = (index %= 10) < 5 ? (index > 2 ? 2 : index): 0; }

        return(words[index]);
    };

    //расчет количества материала
    _this.count_material = function(calc, numb){
        if (calc === 0) {
            return 0;
        } else if (calc === 1) {
            return 1;
        }
        var calculation = 0;
        $.each(_this.rooms, function(key, room) {
            if (key === numb){
                var method = 'get'+calc;
                calculation = eval('room.'+method+'()');
            }
        });
        return calculation;
    };
    

}

var smeta = new Smeta();
$(document).ready(function () {
    smeta.init();
});