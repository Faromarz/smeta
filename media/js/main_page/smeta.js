
/**
 * Smeta
 * @type Function
 */
var Smeta = (function() {

    var defaults = {
        rooms: new Array(),
        types: new Array()
    };
    function Smeta() {
        this.countRooms = 0;
        this.roomName = '';
        this.size = 0;
        this.rooms = new Array();
        this.types = new Array();
    };
    // ---------------- возвращает название квартиры
    Smeta.prototype.getNameRoom = function()
    {
        return this.roomName;
    };
    // ---------------- возвращает количество комнат
    Smeta.prototype.getCountRooms = function()
    {
        return this.countRooms;
    };
    // ---------------- возвращает площадь квартиры
    Smeta.prototype.getSize = function()
    {
        return this.size;
    };
    //------------- название квартиры
    Smeta.prototype.setCountRooms = function($count)
    {
        this.countRooms = $count;
        var text_room = '';
        if (this.countRooms===1) text_room = 'однокомнатная квартира';
        else if (this.countRooms===2) text_room = 'двухкомнатная квартира';
        else if (this.countRooms===3) text_room = 'трехкомнатная квартира';
        else if (this.countRooms===4) text_room = 'четырехкомнатная квартира';
        else if (this.countRooms===5) text_room = 'пятикомнатная квартира';
        $('#dop_options_footer_rezult').find('h1:eq(0)').text(text_room);
        $('#budget_repair_estimate-type_and_rate').find('dt:eq(0)').text(text_room);
        this.roomName = text_room;
    };
    //----------------- фиксация площади
    Smeta.prototype.setSize = function($size)
    {
        this.size = $size;
        $('#dop_options_footer_rezult').find('h3:eq(0)').text(number_format($size, 2, ',', ' ')+' м²');
        $('#budget_repair_estimate-type_and_rate').find('dd:eq(0)').text(number_format($size, 2, ',', ' ')+' м²');
    };
    //-------------------- фон для комнат
    Smeta.prototype.getNumbBg = function($obj)
    {
        return  128 * parseInt($($obj).attr("data-numb"));
    };
    //------------- пересчет площади квартиры
    Smeta.prototype.changeSize = function()
    {
        var size = 0;
        $.each(this.rooms, function(key, room) {
            if(room.getEnable()) {
                size += room.getSize();
            }
        });
        this.setSize(size);
    };
    //------------ Дествие что происходит после выбора количества комнат
    Smeta.prototype.selectRoom = function()
    {
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
       // _this.calculation_works();
        this.changeSize();
    };
    //--------- изменение количества комнат
    Smeta.prototype.setRooms = function($obj)
    {
         var _this = this;
//        $("#rooms").css("background-position", '0px -' + _this.getNumbBg($obj) + 'px');
        _this.setCountRooms(parseInt($($obj).attr("data-numb")));
        $.each(_this.rooms, function(key, room) {
            if(room.getType() === 1){
                room.setShow(_this.getCountRooms() > key);
            }
        });
        this.selectRoom();
    };
    //--------- добавление комнаты
    Smeta.prototype.addRooms = function()
    {
         var _this = this;
         var count = _this.getCountRooms();
         if (count >= 5) {
             return alert('Вы не можете добавить больше 5 комнат');
         } else if(count === 0) {
             count = 1;
         }
        _this.setCountRooms(++count);
        $.each(_this.rooms, function(key, room) {
            if(room.getType() === 1){
                room.setShow(_this.getCountRooms() > key);
            }
        });
        $("#rooms").css("background-position", '0px -' + (128 * _this.countRooms) + 'px');
        this.selectRoom();
    };
    // возвращает параметры сметы
    Smeta.prototype.getSmeta = function(options)
    {
        var param = {};
        $.each(this, function(key, param) {
               param[key] = param;
        });
        
        return param;
    };
    //добавление сметы в бд
    Smeta.prototype.addSmeta=function(){
        var _this = this,
            rooms = new Array(),
            open_link = window.open('','_blank');
        _this.preloader(true);
        $.each(_this.rooms, function(key, room) {
            rooms.push(room.getParams());
        });
        $.ajax({
            type: "POST",
            url: "ajax/smeta/add",
            data: {
                "rooms" : JSON.stringify(rooms),
                "types" : _this.types,
                "size" : _this.getSize(),
                "height" : 0,
                "price_materials" : 0,
                "price_work_dem": 0,
                "price_work_mon": 0,
                "time_work_dem": 0,
                "time_work_mon": 0,
                "room_name" : _this.getNameRoom(),
                "count_rooms" : _this.getCountRooms()
            },
            success: function(data){
                var result = JSON.parse(data);
                open_link.location="budget/"+result[0]['smeta_name'];
                _this.preloader(false);
            }
        }, 'json');
    };
    //гифка прелоадера
    Smeta.prototype.preloader = function(status){
        if(status){
            var width = $(window).width()-50;
            $('body').append('<div id="ajaxLoad" style="background:url(/media/img/block-window.gif) center center no-repeat; height: 56px; width:'+width+'px"></div>');
            $.fancybox.open({
                href: '#ajaxLoad',
                padding:0,
                maxWidth: 2048,
                maxHeight: 56,
                minWidth: width,
                minHeight: 56,
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
    // Выбор в меню тарифов, типа ремонта, типа квартиры
    Smeta.prototype.select_rate = function($obj) {
        var _this = this;
        $("#order_options_rate li").removeClass("selected");
        $($obj).addClass("selected");
        _this.setAllTypes($($obj).index(),0,0);
        var id = $($obj).attr("id");
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
    };

    Smeta.prototype.select_repairs = function($obj) {
        var _this = this;
        $("#order_options_repairs li").removeClass("selected");
        $($obj).addClass("selected");
        _this.setAllTypes(0,$($obj).index(),0);
    };

    Smeta.prototype.select_type = function($obj) {
        var _this = this;
        $("#order_options_type li").removeClass("selected");
        $($obj).addClass("selected");
        _this.setAllTypes(0,0,$($obj).index());
    };

    Smeta.prototype.setAllTypes = function(rate, repair, apartment) {
        if (rate!=0) this.types[0] = rate;
        if (repair!=0) this.types[1] = repair;
        if (apartment!=0) this.types[2] = apartment;
    };
    //------------- иницилизация сметы
    Smeta.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        // иницилизация комнат
        $.each(params.rooms, function(key, room) {
            _this.rooms[key] = new Room(_this, room);
            if (room.enable == 1) {
                _this.countRooms++;
            }
        });
        //типы ремонта
        $.each(params.types, function(key, type) {
            _this.types[key] = type;
        });
        //-------выбор тарифа, ремонта и типа квартиры
        $("#order_options_rate").on("click", 'li', function(){_this.select_rate(this);});
        $("#order_options_repairs").on("click", 'li', function(){_this.select_repairs(this)});
        $("#order_options_type").on("click", 'li', function(){_this.select_type(this);});
        //изменение длины комнаты
        $('.smeta_room_square_height_input').on('change', function() {
            var id = $(this).parents('div.smeta_room').data('room-id');
            _this.rooms[id-1].changeLength(this);
            _this.changeSize();
        });
        // изменение ширины комнаты
        $('.smeta_room_square_width_input').on('change', function() {
            var id = $(this).parents('div.smeta_room').data('room-id');
            _this.rooms[id-1].changeWidth(this);
            _this.changeSize();
        });
        
        //выбор комнат у квартиры
        $("#rooms div")
            .hover(
                function() { $("#rooms").css("background-position", "0px -" + _this.getNumbBg(this) + "px"); },
                function() { $("#rooms").css("background-position", '0px -' + (128 * _this.countRooms) + 'px');}
            ).on("click",function(){_this.setRooms(this);});
        $("#top_right_stiker_rooms div")
            .hover(
                function() { $("#top_right_stiker_rooms").css("background-position", "35px -" + (_this.getNumbBg(this) - 20) + "px"); },
                function() { $("#top_right_stiker_rooms").css("background-position", '35px -' + (128 * _this.countRooms - 20) + 'px'); }
            ).on("click",function(){_this.setRooms(this);});
        $("#top_right_stiker p").hover(function(){ $("#top_right_stiker_rooms").show(); },function() {$("#top_right_stiker_rooms").hide();});
        $("#top_right_stiker_rooms").hover(function(){ $("#top_right_stiker_rooms").show(); },function() {$("#top_right_stiker_rooms").hide();});
        
        // добавлене комнаты
        $('#add_room').die("click");
        $('#add_room').on("click", function(){_this.addRooms();});
        
        // формат чисел min = 0 max = 99.99
        $(".input_filter_number")
            .keydown(function(e) {
                if (e.which > 37 || e.which > 40) {
                    var minValue = 0.00;
                    var maxValue = 99.99;
                    var x = Number($(this).val().replace(/\,/, "."));
                    if (parseFloat(x) > maxValue) {
                        $(this).val(maxValue.toFixed(2).replace(/\./, ","));
                    }
                    if (parseFloat(x) < minValue) {
                        $(this).val(minValue.toFixed(2).replace(/\./, ","));
                    }
                }
            })
            .dblclick(function() {
                temp = this.value;
                this.value = '';
            })
            .blur(function() {
                if (this.value === '')
                    this.value = temp;
                if (Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",") !== NaN) {
                    this.value = Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",");
                }
                else {
                    this.value = temp;
                }
            });

        //кнопка перехода на смету клиента
        $("#your_smeta,.send_form").on("click", function() { _this.addSmeta(); });
        _this.preloader(true);
    };

    return new Smeta();
})();

// ================= формат чисел
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '')
      .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + (Math.round(n * k) / k)
          .toFixed(prec);
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
      .split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
      .length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1)
        .join('0');
    }
    return s.join(dec);
}
