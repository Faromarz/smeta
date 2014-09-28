
/**
 * Smeta
 * @type Function
 * 
 * обязательные классы для подлючения room, type
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
        this.doors = new Array(); // !!! внимание это дополнительные двери.
        this.types = null;
        this.height = 0;
    };
    // ---------------- возвращает высоту потолка
    Smeta.prototype.getHeight = function()
    {
        return this.height.getHeight();
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
    // ---------------- возвращает количество дополнительных дверей
    Smeta.prototype.getCountDoors = function()
    {
        var _this = this;
        var countDoor = 0;
        $.each(_this.doors, function(key, door) {
            if(door.getShow()){
                countDoor++;
            }
        });
        return countDoor;
    };
    // ---------------- возвращает площадь квартиры
    Smeta.prototype.getSize = function()
    {
        return this.size;
    };
    //------------- обновление название квартиры
    //вызывается при:
    // добавлении комнаты
    // указании сколько комнат
    // обединении/разединении ванны-туалет
    Smeta.prototype.updateName = function()
    {
        var _this = this;
        var text_room = '';
        if (_this.getCountRooms()===1) text_room = 'однокомнатная квартира';
        else if (_this.getCountRooms()===2) text_room = 'двухкомнатная квартира';
        else if (_this.getCountRooms()===3) text_room = 'трехкомнатная квартира';
        else if (_this.getCountRooms()===4) text_room = 'четырехкомнатная квартира';
        else if (_this.getCountRooms()===5) text_room = 'пятикомнатная квартира';
        else {
            var count = 0;
            $.each(_this.rooms, function(key, room) {
                if(room.getEnable()) {
                    if (count > 0){
                        text_room += ', ';
                    }
                    text_room += room.getTitle();
                    ++count;
                }
            });
            if (text_room === ''){
                text_room = 'УКАЖИТЕ КОЛИЧЕСТВО КОМНАТ';
            }
        }
        $('#dop_options_footer_rezult').find('h1:eq(0)').text(text_room);
        $('#budget_repair_estimate-type_and_rate').find('dt:eq(0)').text(text_room);
        _this.roomName = text_room;
    };
    //------------- изменение количества комнат
    // вызывается при:
    // добавлении комнаты
    // указании сколько комнат
    Smeta.prototype.setCountRooms = function($count)
    {
        var _this = this;
        _this.countRooms = $count;
        $.each(_this.rooms, function(key, room) {
            if(room.getType() === 1){
                room.setShow(_this.getCountRooms() > key);
            }
        });
        _this.selectRoom();
        $("#rooms").css("background-position", '0px -' + (128 * _this.getCountRooms()) + 'px');
        _this.updateName();
        _this.update();
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
        this.update();
    };
    //--------- изменение количества комнат
    Smeta.prototype.setRooms = function($obj)
    {
        var _this = this;
        $.each(_this.rooms, function(key, room) {
            if(room.getType() !== 1){
                var enable = true;
                if ($('.combine').is(':visible') && room.getId() === 8){
                    enable = false;
                }
                if ($('.uncombine').is(':visible') && $.inArray(room.getId(), [9,10]) !== -1){
                    enable = false;
                }
                room.setEnable(enable);
            }
        });
        this.setCountRooms(parseInt($($obj).attr("data-numb")));
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
    };
    //--------- обновление названий дверей
    Smeta.prototype.doorUpdateName = function()
    {
        var _this = this;
        var count = _this.getCountDoors();
        if (count > 1) {
            $('.smeta_door[data-room-id="0"][data-door-key="0"] h1.smeta_text_header').text('Дверь межкомнатная1');
        } else {
            $('.smeta_door[data-room-id="0"][data-door-key="0"] h1.smeta_text_header').text('Дверь межкомнатная');
        }
    };
    //--------- добавление двери
    Smeta.prototype.addDoor = function()
    {
         var _this = this;
         var count = _this.getCountDoors();
         if (count >= 3) {
             return alert('Вы не можете добавить больше 3 дверей');
         }
        _this.doors[count].setShow(true);
        _this.doorUpdateName();
    };
    
    // возвращает параметры сметы
    Smeta.prototype.getSmeta = function()
    {
        var param = {};
        $.each(this, function(key, param) {
               param[key] = param;
        });
        
        return param;
    };
    // возвращает параметры дополнительных дверей
    Smeta.prototype.getDoorsParams = function()
    {
        var doors = {};
        $.each(this.doors, function(key, door) {
               doors[key] = door.getParams();
        });
        
        return doors;
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
                "repair_id" : _this.types.getRepair(),
                "rate_id" : _this.types.getRate(),
                "apartment_id" : _this.types.getApartment(),
                "size" : _this.getSize(),
                "height" : _this.getHeight(),
                "price_materials" : 0,
                "price_work_dem": 0,
                "price_work_mon": 0,
                "time_work_dem": 0,
                "time_work_mon": 0,
                "room_name" : _this.getNameRoom(),
                "count_rooms" : _this.getCountRooms(),
                "doors" : JSON.stringify(_this.getDoorsParams())
            },
            success: function(data){
                var result = JSON.parse(data);
                open_link.location="budget/"+result[0]['smeta_name'];
                _this.preloader(false);
            }
        }, 'json');
    };
    // обединение ванны+туалет
    Smeta.prototype.changeCombine = function($this, $obj) {
        var _this = $this;
        $($obj).hide();
        if ($($obj).hasClass('combine')) {
            $('#bath').slideUp();
            $('#toilet').slideUp(400, function() {
                _this.rooms[7].setShow(true);
                _this.rooms[7].setEnable((_this.rooms[8].getEnable() || _this.rooms[9].getEnable() )? true : false );
                _this.rooms[8].setShow(false);
                _this.rooms[9].setShow(false);
                $('#bath_and_toilet').slideDown(400, function() {
                    $('.uncombine').fadeIn();
                });
                _this.updateName();
                _this.update();
            });
        } else if ($($obj).hasClass('uncombine')) {
            $('#bath_and_toilet').slideUp(400, function() {
                _this.rooms[8].setShow(true);
                _this.rooms[9].setShow(true);
                _this.rooms[8].setEnable(_this.rooms[7].getEnable());
                _this.rooms[9].setEnable(_this.rooms[7].getEnable());
                _this.rooms[7].setShow(false);
                $('#toilet').slideDown();
                $('#bath').slideDown(400, function() {
                    $('.combine').fadeIn();
                });
                _this.updateName();
                _this.update();
            });
        }
    };
    // обновление сметы
    Smeta.prototype.update = function()
    {
        // вызывается при
        // 1 изменение ширины, длины комнаты
        // 2 изменение количества комнат комнат
        this.changeSize();
        // !!! возможны зацикливания !!!
        // перерасчет материалов, работ, общей цены
        console.log('должен быть общий перерачет сметы (вызывать аккуратно после изменений чего либо)');
    };

    //------------- иницилизация сметы
    Smeta.prototype.init = function(options)
    {
        var _this = this;
        _this.types = Type;
        _this.height = Height;
        var params = $.extend(defaults, options);
        
        // иницилизация комнат
        $.each(params.rooms, function(key, room) {
            _this.rooms[key] = new Room(_this, room);
        });
        
        // иницилизация дополнительных дверей
        $.each(params.doors, function(key, door) {
            _this.doors[key] = new Door(_this, null, key, door);
        });
        _this.doorUpdateName();
        
        // типы ремонта
        _this.types.init(params.types);
        
        // высота потолка
        params.params[0]['parent'] = _this;
         _this.height.init(params.params[0]);
        
        // изменение длины комнаты
        $('.smeta_room_square_height_input').on('change', function() {
            var id = $(this).parents('div.smeta_room').data('room-id');
            _this.rooms[id-1].changeLength(this);
            _this.update();
        });
        // изменение ширины комнаты
        $('.smeta_room_square_width_input').on('change', function() {
            var id = $(this).parents('div.smeta_room').data('room-id');
            _this.rooms[id-1].changeWidth(this);
            _this.update();
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
        
        // добавление двери
        $("#add_door").on("click", function() {
            _this.addDoor(); 
        });
        
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
        // обединение туалет ванна
        $('.combine, .uncombine').on('click', function(){_this.changeCombine(_this, this);});
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
