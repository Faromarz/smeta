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
    // 1. Нужна реализация класов окон, дверей, работ, материалов
    var _this = this;
    var _parent = $parent;
    var _params = $params;

    _this.id = Number(_params.id);
    _this.type = Number(_params.type);
    _this.title = _params.title;
    _this.width = Number(_params.width);
    _this.length = Number(_params.length);
    _this.enable = _params.enable || false;
    _this.show = Number(_params.show) || false;
    _this.materials = new Array();
    _this.windows = {};
    _this.doors = {};
    _this.door = {};
    _this.door.count = 1;
    _this.door.width = 0.90;
    _this.door.getCount = function(){return _this.door.count; };
    _this.door.getWidth = function(){return _this.door.width; };

    if (_params.balcony) {
        _this.balcony = Number(_params.balcony);
    }
    // ID комнаты
    _this.getId = function() {
        return _this.id;
    };
    // тип комнаты
    _this.getType = function() {
        return _this.type;
    };
    // изменить тип комнаты
    _this.setType = function($type) {
        return _this.type = $type;
    };
    // название комнаты
    _this.getTitle = function() {
        return _this.title;
    };
    // изменить название комнаты
    _this.setTitle = function(title) {
        _this.title = title;
    };
    // ширина комнаты
    _this.getWidth = function() {
        return  _this.width;
    };
    // изменить ширину комнаты
    _this.setWidth = function($width) {
        _this.width = $width;
    };
    //  длинна комнаты
    _this.getLength = function() {
        return _this.length;
    };
    // изменить длинну комнаты
    _this.setLength = function($length) {
        _this.length = $length;
    };
    // площадь комнаты
    _this.getSize = function() {
        return Number(_this.width * _params.length);
    };
    // периметр комнаты
    _this.getPerimeter = function() {
        return Number((_this.width + _this.length) * 2);
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
        return _this.show;
    };
    /**
     * 
     * @param {Boolean} show
     */
    _this.setShow = function(show) {
        _this.show = show;
    };
    // наличие галочки в комнате
    _this.getEnable = function() {
        return _this.enable;
    };
    // установка|снятие галочки в комнате
    _this.setEnable = function($enable) {
        _this.enable = $enable;
    };
    // статус балкона
    _this.getBalcon = function() {
        return _this.balcon;
    };
    // изменить статус балкона
    _this.setBalcon = function($type) {
        return _this.balcon = $type;
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
        if (_this.getBalcon() !== undefined) {
            params['balcon'] = _this.getBalcon();
        }
        return params;
    };
    // иницилизация комнаты
    _this.init = function() {
        
    };
    _this.init();
}