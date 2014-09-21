
/**
 * Smeta
 * @type Function
 */
var Budget = (function() {
    

    var defaults = {
        rooms: new Array()
    };

    function Budget() {};
    Budget.prototype = Smeta;
    Budget.prototype.init = function(options){
        var _this = this;
        var params = $.extend(defaults, options);
        // иницилизация комнат
        $.each(params.rooms, function(key, room) {
            _this.rooms[key] = new Room(_this, room, key);
            if (room.enable == 1) {
                _this.countRooms++;
            }
        });
        //изменение длины комнаты
        $('.smeta_room_square_height_input').on('change', function() {
            var key = $(this).parents('div.smeta_room').data('room-key');
            _this.rooms[key].changeLength(this);
            _this.changeSize();
        });
        // изменение ширины комнаты
        $('.smeta_room_square_width_input').on('change', function() {
            var key = $(this).parents('div.smeta_room').data('room-key');
            _this.rooms[key].changeWidth(this);
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
        
    };
    
     return new Budget();
})();


$(document).ready(function(){
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

    //кнопка открытия комнат       
    $("#change_budget").on("click", function(){$("#budget_dop_options").slideDown(350); $("#budget_dop_options-hide").fadeIn(400, function() {  mail_top = $("#mail").offset().top;}); });
    //кнопка закрытия комнат 
    $("#budget_dop_options-hide").on("click", function(){$("#budget_dop_options").slideUp(350); $("#budget_dop_options-hide").fadeOut(400, function() {mail_top = $("#mail").offset().top;});} )
});


