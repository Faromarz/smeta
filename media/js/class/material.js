/**
 * Material
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {object} $room
 * @param {array}  $params
 */
function Material($parent, $room, $params)
{
    var _this = this;
    var _parent = $parent;
    var _room = $room;
    var _params = $params;
    var _id = _params.id;
    var _name = _params.name;

    // ID материала
    _this.getId = function() {
        return _id;
    };
    // название материала
    _this.getName = function() {
        return roomTitle;
    };
  
    // иницилизация материала
    _this.init = function() {
        
    };
    _this.init();
}