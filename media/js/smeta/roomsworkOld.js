/**
 * 
 * @type Function
 */
var RoomsWork = (function() {

    var defaults = {
        count: 0,
        type: 0,
        price_all: 0
    };
    var _parent = {};
    var _room = {};
    var _cat_id = false;
    var _param = {};

    function RoomsWork() {
        this.params = {};
        this.enable = false;
        this.type = defaults.type;
        this.work = [];
        this.count = defaults.count;
        this.price_all = defaults.price_all;
    };
    RoomsWork.prototype.setEnable = function($enable) {
        this.enable = $enable;
    };
    RoomsWork.prototype.updateCount = function() {

        var count = this.work.count;
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
        RoomsWork.prototype.getCount = eval("(function(){return " + new_count + ";})");
        this.count = this.getCount();
        if (this.count === undefined) {
            alert('ERROR 404 workId:' + _room.id);
            this.count = 1;
        } else if (this.work.price === undefined) {


        }
        this.price_all = this.work.price * this.count;
        if (isNaN(this.price_all)) {
            alert('ERROR 404 workId:' + _room.getType());
            this.price_all = 0;
        }

        return true;
    };
    RoomsWork.prototype.update = function() {
        if (this.type === 0) {
            this.work = _parent.works_dem[_room.type][_cat_id][_param.key];
        } else if (this.type === 1) {
            this.work = _parent.works_mon[_room.type][_cat_id][_param.key];
        }
        this.updateCount();
    };
    RoomsWork.prototype.init = function($parent, $room, $cat_id, $param) {
        _parent = $parent;
        _room = $room;
        _cat_id = $cat_id;
        _param = $param;

        this.enable = _room.enable;
        this.type = _param.type;
        this.work = [];
        this.count = defaults.count;
        this.price_all = defaults.price_all;
        this.update();
        
        return this;
    };
    return new RoomsWork();
})();
