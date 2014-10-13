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

    // ID работы
    _this.getId = function() {
        return _id;
    };
    // название работы
    _this.getName = function() {
        return _name;
    };

    // иницилизация работы
    _this.init = function() {
        
    };
    _this.init();
}