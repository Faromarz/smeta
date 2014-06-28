/*
 * smeta калькулятор
 *
 * @author 	senj
 * @version 1.1
 */
var _this = this;
var smeta = {};

function Smeta() {
    var _this = this;
    _this.rooms = {};
    _this.rooms.room = [];
    _this.rooms.repair_ebp = 0;
    _this.rooms.repair_cc = 0;
    _this.rooms.repair_nv = 0;
    _this.rooms.height = 0;

    _this.rooms.partner_id = false;
    _this.rooms.geo_id = 82592;
    _this.rooms.size = 0;
    _this.rooms.price_materials = 0;
    _this.rooms.price_work_dem = 0;
    _this.rooms.price_work_mon = 0;
    _this.rooms.time_work_dem = 0;
    _this.rooms.time_work_mon = 0;
    _this.rooms.room_name = 'ДЛЯ КАКОЙ КВАРТИРЫ РАССЧИТАТЬ СМЕТУ?';

    var initCategory = false;
    _this.getInitCategory = function() {
        return initCategory;
    };
    _this.setInitCategory = function($bollean) {
        initCategory = $bollean;
        _this.setupRoomList.updateMaterials();
    };

    // это нужно загрузить
    _this.categories = [];
    _this.materials = [];
    _this.works_dem = [];
    _this.works_mon = [];
    _this.windows_framuga = [];

    _this.load = new Load(_this,1);
//    LoadModific(_this);
    _this.calc = new Calc(_this);
    _this.calcRoomSize = new CalcRoomSize(_this);
    CalcRoomSizeModific(_this);
    _this.calcRemontCC = new CalcRemontCC(_this);
    _this.calcRemontNV = new CalcRemontNV(_this);
    _this.calcRoomHeight = new CalcRoomHeight(_this);
    CalcRoomHeightModific(_this);
//    _this.calcRoomGeo = new CalcRoomGeo(_this);
    _this.calcRemontEBP = new CalcRemontEBP(_this);
    _this.setupRoomList = new SetupRoomList(_this);// Комнаты
    _this.roomsWindows = new RoomsWindows(_this);
    _this.roomsDoor = new RoomsDoor(_this);

    _this.ajaxLoad = function($status) {
        if ($status) {
            $('body').append('<img src="/media/img/ajax-loader.gif" id="ajaxLoad" style="top: 50%;position: fixed;left: 50%;width: 180px;margin-left: -90px;height: 50px;margin-top: -25px;">');
        } else {
            $('body #ajaxLoad').remove();
        }
    };
    _this.initCategoties = function(){
        var room, cat;
        for (room in _this.rooms.room){
            _this.rooms.room[room].initCategories();
            for (cat in _this.rooms.room[room].categories){
                var materials = _this.rooms.room[room].categories[cat].getMaterials();
                var scroll = _this.rooms.room[room].categories[cat].material_scroll;
                materials[scroll] = rooms[room].categories[cat].material_selected;
                _this.rooms.room[room].categories[cat].setMaterials(materials);
//                _this.rooms.room[room].categories[cat].material_selected = rooms[room].categories[cat].material_selected;
//                _this.rooms.room[room].categories[cat].material_selected = rooms[room].categories[cat].material_selected;
                console.log(_this.rooms.room[room].categories[cat]);
            }
        }
    };
    _this.init = function() {
        $(".last_calculations_form").on("click", function() {
            $(".last_calculations_pop-up[data-id='" + $(this).attr('data-id') + "']").show();
        });
        $(".last_calculations_pop-up_close").on("click", function() {
            $(".last_calculations_pop-up").hide();
        });

        // Инициализация комнат
        _this.setupRoomList.init();

	// Инициализация модулей калькулятора
        _this.load.init();
        _this.calc.init();
//        _this.calcRoomPartner.init();
        _this.calcRoomSize.init();
        _this.calcRemontCC.init();
        _this.calcRemontNV.init();
//        _this.calcRoomCount.init();
        _this.calcRoomHeight.init();
        //_this.calcRoomGeo.init();
        _this.calcRemontEBP.init();
        _this.roomsWindows.init();
        _this.roomsDoor.init();

        initInputFilters();
        
    };
}

function initInputFilters()
{
    var temp = '';
    $(".input_filter")
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

}

$(document).ready(function() {
    smeta = new Smeta();
    smeta.init();
    console.log(smeta);
    console.log(rooms);
    console.log(data);
});
