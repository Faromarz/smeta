/**
 * Work
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {object} $room
 * @param {array}  $params
 */
function Work($parent, $room, $params)
{
    var _this = this,
        _parent = $parent,
        _room = $room,
        _params = $params,
        _type = _params.type,
        _id = _params.id,
        _name = _params.name;
        _repairIds = _params.repair_ids;
        _apartment = _params.types_apartment_ids;
        _cat_arr = _params.cat_arr;
        _count = _params.count;
        _price = _params.price;
        _watch = _params.watch;

    // ID работы
    _this.getId = function() {
        return _id;
    };
    // название работы
    _this.getName = function() {
        return _name;
    };
    // тип работы
    _this.getWatch = function() {
        return _watch;
    };
    // время работы
    _this.getType = function() {
        return _type;
    };
    // типы ремонта
    _this.getRepair = function() {
        return _repairIds === null ? null : _repairIds.split(',');
    };
    // типы квартиры
    _this.getApartment = function() {
        return _apartment;
    };
    // типы квартиры
    _this.getCatId = function() {
        return _cat_arr === null ? null : _cat_arr.split(',');
    };
    // цена квартиры
    _this.getPrice = function() {
        return _price;
    };
    // расчет работы
    _this.getSumma = function(){
        var count = _count;
        var new_count = '';
        if (count.indexOf('S') + 1) {
            new_count = count.replace("S", "Number(Smeta.rooms["+_room.getNumber()+"].getSize())");
        } else if (count.indexOf('CD') + 1) {
            new_count = count.replace("CD", "Number(_room.getCountDoors())");
        } else if (count.indexOf('CW') + 1) {
            new_count = count.replace("CW", "Number(_room.getCountWindows())");
        } else if (count.indexOf('C') + 1) {
            new_count = count.replace("C", "Number(_parent.getCountRooms())");
        } else if (count.indexOf('PW') + 1) {
            new_count = count.replace("PW", "Number(_room.getSizeWall())");
        } else if (count.indexOf('P') + 1) {
            new_count = count.replace("P", "Number(_room.getPerimeter())");
        } else {
            new_count = count;
        }
        var result = eval(new_count);
        return result;
    };
    // параметры для сметы
    _this.getParams = function() {
        var params = {
            work_id: _this.getId(),
            price : _this.getPrice(),
            count : _this.getSumma()
        };
        return params;
    };
    // иницилизация работы
    _this.init = function() {
        
    };
    _this.init();
}