
function RoomsWork($parent, $room, $cat_id, $param)
{
    var _this = this;
    var _parent = $parent;
    var _room = $room;
    var _cat_id = $cat_id;
    var _param = $param;

    _this.enable = _room.enable;
    _this.type = _param.type;
    _this.work = [];
    _this.count = 0;
    _this.price_all = 0;

    _this.setEnable = function($enable) {
        _this.enable = $enable;
    };
    _this.getParam = function($param) {
        if (_param.type === 0) {
//               _parent.works_dem[_room.type][_parent.works_dem[_room.type][_cat_id].id];
        } else if (_param.type === 1) {
//                _parent.works_mon[]                       
        } else {
            alert('Не указан вид работ');
        }
    };
    _this.update = function() {
        if (_this.type === 0) {
            _this.work = _parent.works_dem[_room.type][_cat_id][_param.key];
        } else if (_this.type === 1) {
            _this.work = _parent.works_mon[_room.type][_cat_id][_param.key];
        }
        _this.updateCount();
    };
    _this.updateCount = function() {

        var count = _this.work.count;
        var new_count = '';
        if (count.indexOf('S') + 1) {
            new_count = count.replace("S", "Number(_room.getSize())");
        } else if (count.indexOf('CD') + 1) {
            new_count = count.replace("CD", "Number(_room.getDoor())");
        } else if (count.indexOf('CW') + 1) {
            new_count = count.replace("CW", "Number(_room.getWindow())");
        } else if (count.indexOf('C') + 1) {
            new_count = count.replace("C", "Number(_patent.SetupRoomList.getCountRoom())");
        } else if (count.indexOf('PW') + 1) {
            new_count = count.replace("PW", "Number(_room.getPerimeterWall())");
        } else if (count.indexOf('P') + 1) {
            new_count = count.replace("P", "Number(_room.getPerimeter())");
        } else {
            new_count = count;
        }
        _this.getCount = eval("(function(){return " + new_count + ";})");
        _this.count = _this.getCount();
        if (_this.count === undefined) {
            alert('ERROR 404 workId:' + _room.id);
            _this.count = 1;
        } else if (_this.work.price === undefined) {


        }
        _this.price_all = _this.work.price * _this.count;
        if (isNaN(_this.price_all)) {
            alert('ERROR 404 workId:' + _room.getType());
            _this.price_all = 0;
        }

        return true;
    };
    _this.init = function() {
        _this.update();
    };
    _this.init();
}