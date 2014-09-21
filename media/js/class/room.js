/**
 * Room
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {array} $params
 * @param {integer} $key
 */
function Room($parent, $params)
{
    // 1. Нужна реализация класов окон, дверей, работ, материалов
    var _this = this;
    var _parent = $parent;
    var _params = $params;

    var roomId = Number(_params.id);
    var roomType = Number(_params.type);
    var roomTitle = _params.name;
    var roomWidth = Number(_params.width);
    var roomLength = Number(_params.length);
    var roomEnable = _params.enable || false;
    var roomShow = Number(_params.show) || false;
    var htmlBlock = '.smeta_room';
    _this.materials = new Array();
    _this.works = new Array();
    _this.doors = {};
    _this.door = {};
    _this.door.count = 1;
    _this.door.width = 0.90;
    _this.door.getCount = function(){return _this.door.count; };
    _this.door.getWidth = function(){return _this.door.width; };

    if (_params.balcony) {
        var balcony = Number(_params.balcony);
        // статус балкона
        _this.getBalcon = function() {
            return balcony;
        };
        // изменить статус балкона
        _this.setBalcon = function($type) {
            balcony = $type;
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
    // периметр комнаты
    _this.getPerimeter = function() {
        return Number(_this.getWidth() + _this.getLength()) * 2;
    };
    // площадь окон
    _this.getSizeWindows = function() {
        return 0;
    };
    // площадь дверей
    _this.getSizeDoor = function() {
        return 0;
    };
    // периметр стен с вычетом площади окон и дверей (+балкон).
    _this.getSizeWall = function (){
        var _perimeter = _this.getPerimeter() * _parent.getHeight() - _this.getSizeDoor();
        if (_this.balcony !== undefined) {
            _perimeter -=   Number( _this.getBalcon() ? 1.6 : 0);
        }
        if (_this.windows !== undefined) {
            _perimeter -=   Number(_this.getSizeWindows());
        }
        return _perimeter;
    };
    /**
     * @return {Boolean}
     */
    _this.getShow = function() {
        return roomShow;
    };
    /**
     * 
     * @param {Boolean} show
     */
    _this.setShow = function($show) {
        roomShow = $show;
        _this.setEnable($show);
        if (roomShow) {
            //_this.add_window($('.smeta_room[data-room]').length+1);
            var length = $('.smeta_room[data-room]').length;
            if(_this.getId()>length){
                $("#add_room").siblings('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length).attr('data-room-id', $('.smeta_room[data-room]').length);
                $("#add_room").siblings('.smeta_room').eq(_this.getId()-1).find('p.smeta_text_header').eq(0).text(_this.getTitle());
            }
        } else {
            _this.removeRoom();
        }
    };
    // наличие галочки в комнате
    _this.getEnable = function() {
        return roomEnable;
    };
    // установка|снятие галочки в комнате
    _this.setEnable = function($enable) {
        roomEnable = $enable;
        $('.smeta_room[data-room-id="'+_this.getId()+'"]').find('div:eq(6)').attr('class', 'ignore'+($enable?'':'d'));
        _parent.changeSize();
    };
    // общее количество окон в комнате
    _this.getCountWindows = function() {
        var count = 0;
        $.each(_this.windows, function(key, window) {
            count += window.getCount();
        });
        return count;
    };
    // общее количество дверей в комнате
    _this.getCountDoors = function() {
        var count = 0;
        $.each(_this.doors, function(key, door) {
            count += door.getCount();
        });
        return count;
    };
    // количество петлей на дверь
    _this.getCountLoops = function() {
        return _this.getCountDoors() * 2;
    };
    // ширина проемов дверей
    _this.getWidthDoors = function() {
        var width = 0;
        $.each(_this.doors, function(key, door) {
            width += door.getWidth() * door.getCount();
        });
        return width;
    };
    // периметр комнаты с вычетом промежутков дверей
    _this.getCountPlinth = function() {
        return _this.getPerimeter() - _this.getWidthDoors();
    };
    // площадь фартука
    _this.getSizeApron = function() {
        return _this.getSize() > 12 ? 3.5 : 2.5;
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
            show: _this.getShow()
        };
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
        $("#add_room").siblings('.smeta_room[data-room='+_this.getId()+']').remove();
        // удаление окон вынести в окна
        $("#add_window").siblings('.smeta_window[data-room='+_this.getId()+']').remove();
    };
    // иницилизация комнаты
    _this.init = function() {
        
    };
    _this.init();
}