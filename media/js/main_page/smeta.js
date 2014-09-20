
/**
 * Smeta
 * @type Function
 */
var Smeta = (function() {

    var defaults = {
        paramRooms: new Array()
    };
    function Smeta() {
        this.rooms = new Array();
    };

    Smeta.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        // иницилизация комнат
        $.each(params.paramRooms, function(key, room) {
            _this.rooms[key] = new Room(_this, room);
        });


    };

    return new Smeta();
})();