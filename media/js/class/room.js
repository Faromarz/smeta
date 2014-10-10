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

    _this.materials = _params.materials;

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
    _this.getCategoties = function() {
        var params = new Array();
        $.each(_this.categories, function(key, cat) {
            params.push(cat.getParams());
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
            categories: _this.getCategoties(),
            materials_enable: _this.getMaterialsEnable()
        };
        if (_this.window !== null) {
            params['window'] = _this.window.getParams();
        }
        if (balcony !== undefined) {
            params['balcony'] = _this.getBalcon();
        }
        return params;
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
        $(".selectbox").selectbox();
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
        $.each(_params.categories, function(key, cat) {
            cat.materials = new Array();
            cat.materials = $.extend(true, [], _params.materials);
            _this.categories.push(new Category(_parent, _this, cat));
        });

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