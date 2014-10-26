/**
 * Room
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {array} $params
 */
function Room($parent, $params)
{
    // 1. Нужна реализация класов  материалов, работ
    var _this = this;
    var _parent = $parent;
    var _params = $params;
    var number = _params.number;
    var roomId = Number(_params.id);
    var roomType = Number(_params.type);
    var roomTitle = _params.name;
    var roomWidth = Number(_params.width);
    var roomLength = Number(_params.length);
    var roomEnable = Number(_params.enable) || false;
    var roomShow = Number(_params.show) || false;
    var htmlBlock = '.smeta_room';
    var materials_enable = Number(_params.materials_enable) || true;

    _this.categories = new Array();
    // двери
    _this.door = null;
    // окна
    _this.window = null;

//    _this.materials = _params.materials;

    _this.works = new Array();

    if (_params.balcony) {
        var balcony = Number(_params.balcony);
        // статус балкона
        _this.getBalcon = function() {
            return balcony;
        };
        // изменить статус балкона
        _this.setBalcon = function($type) {
            balcony = $type;
            $('.smeta_room[data-room-id="'+_this.getId()+'"]').children('div:eq(1)').children('div:eq(0)').attr('class', 'check_box_'+($type?'in':'out'));
        };
    }
    // ключ
    _this.getNumber = function() {
        return number;
    };
    // ID комнаты
    _this.getId = function() {
        return roomId;
    };
    // тип комнаты
    _this.getType = function() {
        return roomType;
    };
    // изменить тип комнаты
    _this.setType = function($type) {
        return roomType = $type;
    };
    // название комнаты
    _this.getTitle = function() {
        return roomTitle;
    };
    // изменить название комнаты
    _this.setTitle = function($title) {
        roomTitle = $title;
    };
    // ширина комнаты
    _this.getWidth = function() {
        return  roomWidth;
    };
    // изменить ширину комнаты
    _this.setWidth = function($width) {
        roomWidth = $width;
    };
    // изменить ширину комнаты
    _this.changeWidth = function($obj) {
        _this.setWidth($($obj).val().replace(/\,/, "."));
        _this.updateSize();
    };
    //  длинна комнаты
    _this.getLength = function() {
        return roomLength;
    };
    // установить длинну комнаты
    _this.setLength = function($length) {
        roomLength = $length;
    };
    // изменение длины комнаты
    _this.changeLength = function($obj) {
        _this.setLength($($obj).val().replace(/\,/, "."));
        _this.updateSize();
    };
    // площадь комнаты
    _this.getSize = function() {
        return Number(_this.getWidth() * _this.getLength());
    };
    // пересчет комнаты
    _this.updateSize = function() {
        $(htmlBlock+'[data-room-id="'+_this.getId()+'"] h3#square-room').text(number_format(_this.getSize(), 2, ',', ' '));
    };
    /**
     * @return {Boolean}
     */
    _this.getShow = function() {
        return roomShow;
    };
    /**
     * 
     * @param {Boolean} $show
     */
    _this.setShow = function($show) {
        var _this = this;
        roomShow = $show;
        _this.setEnable($show);

        // отображение/скрытие комнат (type == 1)
        if(_this.getType() === 1) {
            if (roomShow) {
                var length = $('.smeta_room[data-room]').length;
                if(_this.getId()>length){
                    $("#add_room").siblings('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length).attr('data-room-id', $('.smeta_room[data-room]').length);
                    $("#add_room").siblings('.smeta_room').eq(_this.getId()-1).find('p.smeta_text_header').eq(0).text(_this.getTitle());
                }
            } else {
                if (_this.getId() !== 1) {
                    _this.removeRoom();
                }
            }
        }
        _this.door.setShow(roomShow);
        if (_this.window !== null){
            _this.window.setShow(roomShow);
        }
    };
    // периметр комнаты
    _this.getPerimeter = function() {
        return Number(_this.getWidth() + _this.getLength()) * 2;
    };
    // площадь окон !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    _this.getSizeWindows = function() {
        return 0;
    };
    // площадь дверей !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    _this.getSizeDoor = function() {
        return 0;
    };
    // периметр стен с вычетом площади окон и дверей (+балкон).
    _this.getSizeWall = function (){
        var _perimeter = _this.getPerimeter() * _parent.getHeight() - _this.getSizeDoor();
        if (_this.balcony !== undefined) {
            _perimeter -=   Number( _this.getBalcon() ? 1.6 : 0);
        }
        if (_this.window !== undefined) {
            _perimeter -=   Number(_this.getSizeWindows());
        }
        return _perimeter;
    };
    
    // наличие галочки в комнате
    _this.getEnable = function() {
        return roomEnable;
    };
    // установка|снятие галочки в комнате
    _this.setEnable = function($enable) {
        roomEnable = $enable;
        _this.door.setEnable($enable);
        if(_this.window !== null) {
            _this.window.setEnable($enable);
        }
        $('.smeta_room[data-room-id="'+_this.getId()+'"]').children('div:eq(2)').attr('class', 'room-enable ignore'+($enable?'':'d'));
        _parent.changeSize();
    };
    // количество окон в комнате
    _this.getCountWindows = function() {
        var count = 0;
        if (_this.window !== null){
             count += _this.window.getCount();
        }
        return count;
    };
    // условная площадь для фартука/рукава
    _this.getAreaApron = function() {
        var count = 2.75;
        return count;
    };
    // количество дверей в комнате
    _this.getCountDoors = function() {
        var count = 0;
        if (_this.door !== null){
             count += _this.door.getCount();
        }
        return count;
    };
    // количество петлей на дверь
    _this.getCountLoops = function() {
        return _this.getCountDoors() * 2;
    };
    // ширина проемов дверей
    _this.getWidthDoors = function() {
        return door.getWidth();
    };
    // периметр комнаты с вычетом промежутков дверей
    _this.getCountPlinth = function() {
        return _this.getPerimeter() - _this.getWidthDoors();
    };
    // площадь фартука
    _this.getSizeApron = function() {
        return _this.getSize() > 12 ? 3.5 : 2.5;
    };
    // параметры категории
    _this.getCategories = function() {
        var params = new Array();
        $.each(_this.categories, function(key, cat) {
            params.push(cat.getParams());
        });
        return params;
    };
    // параметры работ
    _this.getWorks = function() {
        var params = new Array();
        $.each(_this.works, function(key, work) {
            params.push(work.getParams());
        });
        return params;
    };
    // галочка для материалов
    _this.getMaterialsEnable = function() {
        return materials_enable;
    };
    //  статус галочки у материалов
    _this.setMaterialsEnable = function($enable, $changeAll)
    {
        materials_enable = $enable;
        if($changeAll) {
            $.each(_this.categories, function(key, cat) {
                cat.setEnable($enable);
            });
        }
        
        if ($enable) {
            $('.room-material-enable[data-room-id="'+_this.getId()+'"]').removeClass('ignored_4');
            $('.room-material-enable[data-room-id="'+_this.getId()+'"]').addClass('ignore_4');
        } else {
            $('.room-material-enable[data-room-id="'+_this.getId()+'"]').removeClass('ignore_4');
            $('.room-material-enable[data-room-id="'+_this.getId()+'"]').addClass('ignored_4');
        }
        
    };
    // параметры для сметы
    _this.getParams = function() {
        var  params = {
            id: _this.getId(),
            type: _this.getType(),
            title: _this.getTitle(),
            width: _this.getWidth(),
            length: _this.getLength(),
            enable: _this.getEnable(),
            show: _this.getShow(),
            door: _this.door.getParams(),
            categories: _this.getCategories(),
            materials_enable: _this.getMaterialsEnable(),
            works: _this.getWorks()
        };
        if (_this.window !== null) {
            params['window'] = _this.window.getParams();
        }
        if (balcony !== undefined) {
            params['balcony'] = _this.getBalcon();
        }
        return params;
    };
    // сумма материалов комнаты
    _this.getPriceAllMaterials = function() {
        var summa = 0;
        $.each(_this.categories, function(key, cat) {
            if(cat.getEnable()) {
                summa += cat.getPriceMaterial();
            }
        });
        return summa;
    };
    // сумма работ комнаты
    _this.getPriceAllWorks = function() {
        var summa = 0;
        $.each(_this.works, function(key, work) {
                $.each(_this.categories, function (k, cat) {
                    if (cat.getEnable()) {
                            var count = work.getSumma();
                            if (count === undefined) {
                                count = 1;
                            } else if ( work.getPrice() === undefined) {
                            }
                            summa += parseFloat(work.getPrice()) * parseFloat(count);
                            if(Number(work.getType()) === 0){
                                _parent.price_work_dem+=parseFloat(work.getPrice()) * parseFloat(count);
                                _parent.time_work_dem+=parseFloat(work.getWatch());
                            }else{
                                _parent.price_work_mon+=parseFloat(work.getPrice()) * parseFloat(count);
                                _parent.time_work_mon+=parseFloat(work.getWatch());
                            }
                    }
                });
        });
        return summa;
    };
    // удаление комнаты
    _this.removeRoom = function() {
        if (_this.getId() === 1){
            return true;
        }
        // удаление комнаты
        $("#add_room").siblings('.smeta_room[data-room='+_this.getId()+']').remove();
        // удаление окон вынести в окна
        $("#add_window").siblings('.smeta_window[data-room='+_this.getId()+']').remove();
    };

    // обновление категорий
    _this.updateCategoriesHTML = function() {
        var html = '';
        // категории
        $.each(_this.categories, function(key, cat) {
            html += cat.getHTML();
        });
        $('.materials_room_for_options[data-material-block-room-id="'+_this.getId()+'"]').empty().append(html);
        $(".selectbox").selectbox({
            onChange: function (val, inst) {
                var room_id = $(this).attr('data-room-id'),
                    category_id = $(this).attr('data-cat-id');
                $.each(_parent.rooms, function(key, room) {
                    if (room.getId() == Number(room_id)){
                        $.each(room.categories, function(k, cat) {
                            if(cat.getId() == Number(category_id)){
                                cat.newCategory(Number(val));
                            };
                        });
                    };
                });
            }
        });
        $(".slider_img")
            .mouseenter(function() {
                $(this).children(".slider_about").show();
            })
            .mouseleave(function() {
                $(this).children(".slider_about").hide();
            });
    };
    // заполнение работ
    _this.setWorks = function(){
        var add_works = new Array();
        _this.works = new Array();
        $.each(Loaded.works, function(key, work) {
            if(work.room_id === 0 || work.room_id === _this.getId()) {
                var for_types = work.room_type === null ? 1 : work.room_type.split(',');
                if ($.inArray("" + _this.getType(), for_types) !== -1 || work.room_type === null) {
                    if (_parent.types.getApartment() == work.types_apartment_ids) {
                        var repair = work.repair_ids === null ? null : work.repair_ids.split(',');
                        if ($.inArray(_parent.types.getCombination(), repair) !== -1 || repair === null) {
                            $.each(_this.categories, function (k, cat) {
                                var cat_arr = work.cat_arr === null ? null : work.cat_arr.split(',');
                                if ($.inArray(cat.getChildrenId() === null ? ''+cat.getId() : ''+cat.getChildrenId(), cat_arr) !== -1 || cat_arr === null) {
                                    if($.inArray(work.id, add_works) === -1) {
                                        _this.works.push(new Work(_parent, _this, work));
                                        add_works.push(work.id);
                                    }
                                }
                            });
                        }
                    }
                }
            }
        });
    };
    // иницилизация комнаты
    _this.init = function() {
        // ========== двери
        _this.door = new Door(_parent, _this, 0, _params.door);
        // ========== окна
        if (_params.window !== null){
            _this.window = new Window(_parent, _this, 0, _params.window);
        }
        // ========== категории
        var i=0;
        $.each(_params.categories, function(key, cat) {
//            cat.materials = new Array();
//            cat.materials = $.extend(true, [], _params.materials);
            cat.number = i;
            _this.categories.push(new Category(_parent, _this, cat));
            i++;
        });
        _this.setWorks();
        // click enable room
        $(htmlBlock+'[data-room-id="'+_this.getId()+'"] div:eq(6)').live("click", function() {
            $(this).toggleClass("ignore ignored");
            _this.setEnable($(this).hasClass('ignore'));
            // пересчет комнат
            if (_parent.getCountRooms() === 0) {
                var count = 0;
                if (_this.getType() === 1) {
                    count = 1;
                }
                _parent.setCountRooms(count);
            } else {
                _parent.update();
            }
         });
         // галочка у всех материалов
        $('.room-material-enable[data-room-id="'+_this.getId()+'"]').on('click', function() {
            $(this).toggleClass('ignore_4 ignored_4');
            _this.setMaterialsEnable($(this).hasClass('ignore_4'), true);
            _parent.update();
        });
        
        // click balcon
        $(htmlBlock+'[data-room-id="'+_this.getId()+'"] div:eq(5)').live("click", function() {
            $(this).toggleClass("check_box_out check_box_in");
            _this.setBalcon($(this).hasClass('check_box_in'));
         });
         _this.updateCategoriesHTML();
    };
    _this.init();
}