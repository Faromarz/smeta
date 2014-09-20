
/**
 * Smeta
 * @type Function
 */
var Smeta = (function() {

    var defaults = {
        rooms: new Array()
    };
    function Smeta() {
        this.countRooms = 0;
        this.roomName = '';
        this.size = 0;
        this.rooms = new Array();
    };
    //------------- установка количество комнат
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
        this.roomName = text_room;
    };
    //----------------- фиксация площади
    Smeta.prototype.setSize = function($size)
    {
        this.size = $size;
        $('#dop_options_footer_rezult').find('h3:eq(0)').text($size+' м²');
    };
    //-------------------- фон для комнат
    Smeta.prototype.getNumbBg = function($obj)
    {
        return  128 * parseInt($($obj).attr("data-numb"));
    };
    //------------- изменение площади квартиры
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
    //--------- установка количества комнат
    Smeta.prototype.setRooms = function($obj)
    {
         var _this = this;
//        $("#rooms").css("background-position", '0px -' + _this.getNumbBg($obj) + 'px');
        _this.setCountRooms(parseInt($($obj).attr("data-numb")));
        $.each(_this.rooms, function(key, room) {
            if(room.getType() === 1){
                room.setShow(_this.countRooms > key);
            }
        });
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
    //------------- иницилизация сметы
    Smeta.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        // иницилизация комнат
        $.each(params.rooms, function(key, room) {
            _this.rooms[key] = new Room(_this, room, key);
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

    };

    return new Smeta();
})();