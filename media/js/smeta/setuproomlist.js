/**
 * иницилизация комнат
 *
 * @author 	senj
 * @version 1.1
 * 
 * @param {object} $parent description
 */
function SetupRoomList($parent)
{
    var _parent = $parent;
    var _this = this;
    var _elements;
    var _params;
    var roomCountMax = 5;
    var backgr_position = "0";
    var _wrap = "#materials .materials_room .room-mat";
    var name_room = {
        0: 'ДЛЯ КАКОЙ КВАРТИРЫ РАССЧИТАТЬ СМЕТУ?',
        1: 'ОДНОКОМНАТНАЯ КВАРТИРА',
        2: 'ДВУХКОМНАТНАЯ КВАРТИРА',
        3: 'ТРЕХКОМНАТНАЯ КВАРТИРА',
        4: 'ЧЕТЫРЕХКОМНАТНАЯ КВАРТИРА',
        5: 'ПЯТИКОМНАТНАЯ КВАРТИРА'
    };
    _this.roomCount = 0;
    /**
     * 
     * @returns {Number}
     */
    _this.getCountRoom = function() {
        return _this.roomCount;
    };
    _this.delCountRoom = function() {
        _this.roomCount--;
        _this.changeRoom();
    };
    _this.updateName = function() {
        // изменили количество комнат
        if (_this.roomCount > 0) {
            _parent.rooms.room_name = name_room[_this.roomCount];
            $('#dop_options_footer_rezult h2').show();
            $('#dop_options_footer_rezult h3').show();
        } else {
            var html = "";
            for (var room in _parent.rooms.room) {
                if (_parent.rooms.room[room].getEnable()) {
                    if (html === "") {
                        html += _parent.rooms.room[room].getTitle();
                    } else {
                        html += ', ' + _parent.rooms.room[room].getTitle();
                    }
                }
            }
            if (html !== '') {
                _parent.rooms.room_name = html;
                $('#dop_options_footer_rezult h2').show();
                $('#dop_options_footer_rezult h3').show();
            } else {
                _parent.rooms.room_name = name_room[0];
                $('#dop_options_footer_rezult h2').hide();
                $('#dop_options_footer_rezult h3').hide();
            }

        }
        $('#dop_options_footer_rezult h1').text(_parent.rooms.room_name);
    };
    _this.update = function()
    {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        } else {
            _this.updateMaterials();
        }
//        _this.updateRooms();
//        $('.count_materials').empty();
//        $('.count_materials').text('Всего: '+count_materials_show+' '+declOfNum(count_materials_show,['материал','материала','материалов']));
//        
    };
    _this.updateCountRoom = function()
    {
        _this.roomCount = 0;
        for (_i in _parent.rooms.room) {
            if (_parent.rooms.room[_i].enable() && _parent.rooms.room[_i].getType() === 1) {
                _this.roomCount++;
            }
        }
    };

    /**
     * 
     * @returns {Boolean}
     */
    _this.updateRooms = function() {

        for (_room in _parent.rooms.room) {
            _parent.rooms.room[_room].initCategories();
        }

        return _this.updateMaterials();
    };
    _this.updateMaterials = function()
    {
        if (_parent.load.status === false) {
            alert('Материалы еще не подгрузились, кликните еще раз');
            return false;
        }
        var _room, content = '';
        for (_room in _parent.rooms.room) {
            content += _parent.rooms.room[_room].getGroups();
        }
        _parent.calc.update();

        $(_wrap).empty().append(content);
        $(".selectbox").selectbox();
        $(".slider_img")
                .mouseenter(function() {
                    $(this).children(".slider_about").show();
                })
                .mouseleave(function() {
                    $(this).children(".slider_about").hide();
                });
    };
    _this.changeCombine = function() {
        $(this).hide();
        // меняем на ванну + туалет
        if ($(this).hasClass('combine')) {
            $(this).removeClass('combine');
            $(this).addClass('uncombine');
            $('#bath').slideUp();
            $('#toilet').slideUp(400, function() {
                for (var room in _parent.rooms.room) {
                    if (_parent.rooms.room[room].getType() === 4) {
                        _parent.rooms.room[room].setTitle('ванна и туалет');
                        _parent.rooms.room[room].initCategories();
                    } else if (_parent.rooms.room[room].getType() === 5) {
                        _parent.rooms.room[room].setEnable(false);
                        _parent.rooms.room[room].setTitle('hidden');
                        _parent.rooms.room[room].initCategories();
                    }
                }
                _parent.calcRoomSize.update();
                $('#bath').slideDown(400, function() {
                    $('.uncombine').fadeIn();
                });
            });
            // меняем на ванну, туалет 
        } else if ($(this).hasClass('uncombine')) {
            var _enable = false;
            $(this).removeClass('uncombine');
            $(this).addClass('combine');
            $('#bath').slideUp(400, function() {
                for (var room in _parent.rooms.room) {
                    if (_parent.rooms.room[room].getType() === 4) {
                        _parent.rooms.room[room].setTitle('ванна');
                        _enable = _parent.rooms.room[room].getEnable();
                        _parent.rooms.room[room].initCategories();
                    } else if (_parent.rooms.room[room].getType() === 5) {
                        _parent.rooms.room[room].setEnable(_enable);
                        _parent.rooms.room[room].setTitle('туалет');
                        _parent.rooms.room[room].initCategories();
                    }
                }
                _parent.calcRoomSize.update();
                $('#toilet').slideDown();
                $('#bath').slideDown(400, function() {
                    $('.combine').fadeIn();
                });
            });
        }
        console.log('Обединение Вана туалет');
    };

    /**
     * 
     * @returns {Boolean}
     */
    _this.materialOnOffInRoom = function() {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        }
        $(this).toggleClass("ignore_4 ignored_4");
        var _room;
        var _room_type = Number($(this).attr('data-room-type'));
        var _room_id = Number($(this).attr('data-room-id'));
        var cat_id = Number($(this).attr('data-cat-id'));
        var _cat;
        for (_room in _parent.rooms.room) {
            if (_parent.rooms.room[_room].getType() === _room_type && _parent.rooms.room[_room].getId() === _room_id) {
                for (_cat in _parent.rooms.room[_room].categories) {
                    if (_parent.rooms.room[_room].categories[_cat].cat_id === cat_id) {
                        _parent.rooms.room[_room].categories[_cat].enable = $(this).hasClass('ignore_4');
                        if ($(this).hasClass('ignore_4')) {
                            _parent.rooms.room[_room].categories_enable = true;
                            $('.on-off-all-materials').removeClass('ignored_2').addClass('ignore_2');
                        }
                    }
                }
            }
        }
        return _this.updateMaterials();
    };
    _this.materialsOnOffInRoom = function() {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        }
        $(this).toggleClass("ignore_4 ignored_4");
        var _room;
        var _room_type = Number($(this).attr('data-type'));
        var _room_id = Number($(this).attr('data-id'));
        var _cat;
        for (_room in _parent.rooms.room) {
            if (_parent.rooms.room[_room].getType() === _room_type && _parent.rooms.room[_room].getId() === _room_id) {
                _parent.rooms.room[_room].categories_enable = $(this).hasClass('ignore_4');
                for (_cat in _parent.rooms.room[_room].categories) {
                    _parent.rooms.room[_room].categories[_cat].enable = $(this).hasClass('ignore_4');
                }
            }
        }
        if ($(this).hasClass('ignore_4')) {
            $('.on-off-all-materials').removeClass('ignored_2').addClass('ignore_2');
        }
        _this.updateMaterials();
    };
    _this.materialsOnOffAll = function() {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        }
        $(this).toggleClass("ignore_2 ignored_2");
        var _room;
        var _cat;
        for (_room in _parent.rooms.room) {
            _parent.rooms.room[_room].categories_enable = $(this).hasClass('ignore_2');
            for (_cat in _parent.rooms.room[_room].categories) {
                _parent.rooms.room[_room].categories[_cat].enable = $(this).hasClass('ignore_2');
            }
        }
        _this.updateMaterials();
    };
    _this.changeCatGroup = function() {
        // материалы 100% загружены
        
        var _room_id = Number($(this).attr('data-room-id'));
        var _room_type = Number($(this).attr('data-room-type'));
        var _cat_id = Number($(this).attr('data-cat-id'));
        var _chaild_id = $(this).val();
        var _room;
        var _cat;
        for (_room in _parent.rooms.room) {
            if (_parent.rooms.room[_room].type === _room_type) {
                if (_parent.rooms.room[_room].id === _room_id) {
                    for (_cat in _parent.rooms.room[_room].categories) {
                        if (_parent.rooms.room[_room].categories[_cat].cat_id === _cat_id) {
                            _parent.rooms.room[_room].categories[_cat] = new RoomsCategories(_parent, _cat_id, _parent.rooms.room[_room], {number: _cat, chaild: _chaild_id});
                            _parent.rooms.room[_room].work_dem = [];
                            _parent.rooms.room[_room].work_mon = [];
                            _this.updateMaterials();
                        }
                    }
                }
            }
        }
    };

    /**
     * 
     * @returns {undefined}
     */
    _this.initRooms = function() {
        var room_id;
        for (room_id = 1; room_id <= 5; room_id++) {
            _elements = {
                type: "room"
            };
            _params = {
                id: room_id,
                type: 1,
                width: 3.50,
                length: 5.50,
                title: 'Комната №' + room_id,
                window: [],
                balcon: false
            };
            if (_params.id === 1) {
                _params.door = [];
            } else {
                _params.show = false;
            }
            _parent.rooms.room.push(new Room(_parent, _elements, _params));
        }

        // Kitchen
        _elements = {
            type: "kitchen"
        };
        _params = {
            id: 1,
            width: 3.00,
            length: 3.00,
            title: 'Кухня',
            type: 2,
            window: [],
            balcon: false
        };
        _parent.rooms.room.push(new Room(_parent, _elements, _params));
        // Coridor
        _elements = {
            type: "coridor"
        };
        _params = {
            id: 1,
            width: 2.00,
            length: 3.00,
            title: 'Коридор',
            type: 3,
            door: []
        };
        _parent.rooms.room.push(new Room(_parent, _elements, _params));
        // Bath
        _elements = {
            type: "bath"
        };
        _params = {
            id: 1,
            length: 1.80,
            width: 1.70,
            title: 'Bанна',
            type: 4
        };
        _parent.rooms.room.push(new Room(_parent, _elements, _params));
        // Toilet
        _elements = {
            type: "toilet"
        };
        _params = {
            id: 1,
            width: 0.80,
            length: 1.70,
            title: 'Туалет',
            type: 5
        };
        _parent.rooms.room.push(new Room(_parent, _elements, _params));
        // all
//        _elements = {
//             type: "all"
//        };
//        _params = {
//            id : 1,
//            title: 'Общие материалы',
//            type: 6
//        };
//        _parent.rooms.room.push(new Room(_parent, _elements, _params));

    };
    _this.changeWorkEnable = function() {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        }
        var _type = $(this).attr('data-work');
        $(this).toggleClass('ignore_2 ignored_2');
        if (_type === 'all') {
            var _enable = $(this).hasClass('ignore_2');
            $('.work-change[data-work]').removeClass('ignore_3').removeClass('ignored_3').addClass('ignore' + (_enable ? '' : 'd') + '_3');
        } else {
            var _enable = $(this).hasClass('ignore_3');
        }
        var _room, _dem, _mon;
        for (_room in _parent.rooms.room) {
            if (_parent.rooms.room[_room].enable) {
                if (_type === 0 || _type === 'all') {
                    for (_dem in _parent.rooms.room[_room].work_dem) {
                        if (_parent.rooms.room[_room].work_dem.length > 0) {
                            _parent.rooms.room[_room].work_dem[_dem].setEnable(_enable);
                        }
                    }
                }
                if (_type === 1 || _type === 'all') {
                    for (_mon in _parent.rooms.room[_room].work_mon) {
                        if (_parent.rooms.room[_room].work_mon.length > 0) {
                            _parent.rooms.room[_room].work_mon[_mon].setEnable(_enable);
                        }
                    }
                }
            }
        }
        _this.updateMaterials();
    };
    _this.showRoomAdd = function() {
        var room = $('#dop_options_left .smeta_room[data-room]').length;
        if (roomCountMax > room) {
            if (room >= 1) {
                $('#add_room').parent().children('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length);
                $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore($('#add_window').parent().children('.smeta_window[data-window]').last()).attr('data-window', 1).attr('data-id-room', _parent.rooms.room[room].getId);
            }

            _parent.rooms.room[0].door[0].count += 1;
            _parent.rooms.room[room].setEnable(_this.roomCount > 0 ? true : false);
            _parent.rooms.room[room].update();
            _parent.setupRoomList.update();
            if (_this.roomCount > 0) {
                _this.addCountRoom();
            }
        } else {
            console.log('max комнат ' + roomCountMax);
        }
    };
    _this.addCountRoom = function() {
        _this.roomCount++;
        _this.changeRoom();
    };
    _this.changeRoom = function() {

        _parent.setInitCategory(true);
        backgr_position = 128 * _this.roomCount;
        $("#rooms").css("background-position", '0px -' + backgr_position + 'px');
        $("#top_right_stiker_rooms").css("background-position", '35px -' + (backgr_position - 20) + 'px');
        $("#top_right_stiker_rooms").hide();
        $("#top_right_stiker p").hide();
        $("#top_right_stiker").css("width", "155px");
        $("#top_right_stiker a").css("display", "block");
        $("#partners").hide();
        $("#be_partners").hide();
        $("#your_smeta").show();
        $("#your_price").show();
        $("#examples_works").slideUp();
        $("#last_calculations").slideUp("400", function() {
            $("#materials").slideDown();
            $("#repair_company").slideDown();
        });
        _parent.calcRoomSize.update();
    };
    _this.checkedRoom = function() {
        if (_parent.load.status === false) {
            alert('Материалы еще загружаются..., кликните еще раз');
            return false;
        }
        _parent.setInitCategory(true);
        _this.roomCount = Number($(this).attr('data-id'));
        //Онулируем квартиры
        // очищаем комнаты
        $('#dop_options_left .smeta_room[data-room="2"]').remove();
        $('#dop_options_left .smeta_room[data-room="3"]').remove();
        $('#dop_options_left .smeta_room[data-room="4"]').remove();
        $('#dop_options_left .smeta_room[data-room="5"]').remove();
        // очищаем окна
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="1"][data-window="2"]').remove();
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="1"][data-window="3"]').remove();
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="2"]').remove();
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="3"]').remove();
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="4"]').remove();
        $('#dop_options_right .smeta_window[data-type-room="1"][data-id-room="5"]').remove();
        _parent.rooms.room[0].door[0].count = -1;
        for (var room in _parent.rooms.room) {
            if (room < 5) {
                if (room < _this.roomCount) {
                    if (room > 0) {
                        $('#add_room').parent().children('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length);
                        $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore($('#add_window').parent().children('.smeta_window[data-window]').last()).attr('data-window', 1).attr('data-id-room', _parent.rooms.room[room].getId);
                    }
                    _parent.rooms.room[0].door[0].count += 1;
                    _parent.rooms.room[room].setEnable(true);
                    // перебор категорий комнаты
//                    for (var _cat in _parent.rooms.room[room].categories) {
//                        _parent.rooms.room[room].categories[_cat].setEnable(true);
//                    }
                    // обнуление работ
//                     _parent.rooms.room[room].work_dem = [];
//                     _parent.rooms.room[room].work_mon = [];

//                    _parent.rooms.room[room].update();
                } else {
                    _parent.rooms.room[room].setEnable(false);
//                    for (var _cat in _parent.rooms.room[room].categories) {
//                        _parent.rooms.room[room].categories[_cat].setEnable(false);
//                    }
//                    // перебираем работы демонтаж
//                    for (var _dem in _parent.rooms.room[room].work_dem) {
//                        _parent.rooms.room[room].work_dem[_dem].setEnable(false);
//                    }
//                    // перебираем работы монтажные
//                    for (var _mon in _parent.rooms.room[room].work_mon) {
//                        _parent.rooms.room[room].work_mon[_mon].setEnable(false);
//                    }
//                    _parent.rooms.room[room].update();
                }
            } else {
                _parent.rooms.room[0].door[0].count += 1;
                _parent.rooms.room[room].setEnable(true);
//                for (var _cat in _parent.rooms.room[room].categories) {
//                    _parent.rooms.room[room].categories[_cat].setEnable(true);
//                }
//                // перебираем работы демонтаж
//                for (var _dem in _parent.rooms.room[room].work_dem) {
//                    _parent.rooms.room[room].work_dem[_dem].setEnable(true);
//                }
//                // перебираем работы монтажные
//                for (var _mon in _parent.rooms.room[room].work_mon) {
//                    _parent.rooms.room[room].work_mon[_mon].setEnable(true);
//                }
//                _parent.rooms.room[room].update();
            }
//            for(_i in _parent.rooms.room[room].categories){
//                _parent.rooms.room[room].categories[_i].enable =_parent.rooms.room[room].enable;
//            }
        }
//        _parent.rooms.room[0].door[0].update();
        backgr_position = 128 * _this.roomCount;
        $("#rooms").css("background-position", '0px -' + backgr_position + 'px');
        $("#top_right_stiker_rooms").css("background-position", '35px -' + (backgr_position - 20) + 'px');
        $("#top_right_stiker_rooms").hide();
        $("#top_right_stiker p").hide();
        $("#top_right_stiker").css("width", "155px");
        $("#top_right_stiker a").css("display", "block");
        $("#partners").hide();
        $("#be_partners").hide();
        $("#your_smeta").show();
        $("#your_price").show();
        $("#examples_works").slideUp();
        $("#last_calculations").slideUp("400", function() {
            $("#materials").slideDown();
            $("#repair_company").slideDown();
        });
//        setInterval(function() {
//            $("#your_price_without_discount").fadeToggle();
//        }, 4000);
        _this.update();
        _parent.calcRoomSize.update();
    };
    _this.init = function() {
        _this.initRooms();
        // change combie
        $(document).on('click', '.change-combine', _this.changeCombine);
        // change enable works
        $('#repair_company div[data-work="all"]').on('click', _this.changeWorkEnable);
        // change enable works
        $('.work-change[data-work]').on('click', _this.changeWorkEnable);
        // change select category materials
        $('.selectbox[data-cat-id]').live('change', _this.changeCatGroup);
        // change enable materials
        $('#materials .on-off-all-materials').on('click', _this.materialsOnOffAll);
        $('.room-mat .materials_room_header .on-off-categories').live('click', _this.materialsOnOffInRoom);
        $('.materials_room_option_header .on-off-category').live('click', _this.materialOnOffInRoom);
        // Добавление комнаты +1
        $(document).on("click", "#add_room", _this.showRoomAdd);
        // указываем сколько комнат в квартире 1 - 5
        $("#rooms div").hover(
                function() {
                    $("#rooms").css("background-position", "0 -" + (128 * Number($(this).attr('data-id'))) + "px");
                },
                function() {
                    $("#rooms").css("background-position", '0px -' + backgr_position + 'px');
                }
        ).on("click", _this.checkedRoom);
        $("#top_right_stiker_rooms div").hover(
                function() {
                    $("#top_right_stiker_rooms").css("background-position", "35px -" + (128 * Number($(this).attr('data-id')) - 20) + "px");
                },
                function() {
                    $("#top_right_stiker_rooms").css("background-position", '35px -' + (backgr_position - 20) + 'px');
                }
        ).on("click", _this.checkedRoom);
    };
}