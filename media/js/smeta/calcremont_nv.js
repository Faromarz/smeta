/**
 * новострой вторичк
 *
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent description
 */
function CalcRemontNV($parent)
{
    var _this = this;
    var _parent = $parent;
    var _block = '#order_options_type li';
    var _type = 'old';
    var _nv = {
        new : 6,
        old: 7
    };
    _this.getNVId = function() {
        return _parent.rooms.repair_nv;
    };
    _this.setNVId = function($type) {
        _parent.rooms.repair_nv = _nv[$type];
    };
    _this.init = function()
    {
        $(_block + '[data-type=' + _type + ']').addClass('selected');
        $(_block).on("click", _this.change);
    };
    _this.change = function()
    {
        _type = $(this).attr('data-type');
        _this.setNVId(_type);
        $(_block).removeClass("selected");
        $(_block + '[data-type=' + _type + ']').addClass('selected');
        _parent.setupRoomList.updateRooms();
    };
}
