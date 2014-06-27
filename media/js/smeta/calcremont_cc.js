/**
 * косметический, капитальный
 *
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent description
 * 
 */
function CalcRemontCC($parent)
{
    var _parent = $parent;
    var _this = this;
    var _block = '#order_options_repairs li';
    var _type = 'capital';
    var _cc = {
        'cosmetic':4,
        'capital':5
    };
    _this.getCCId = function()
    {
        return _parent.rooms.repair_cc;
    };
    _this.setCCId = function($type)
    {
        _parent.rooms.repair_cc = _cc[$type];
    };
    _this.init = function()
    {
        $(_block + '[data-type=' + _type + ']').addClass('selected');
        $(_block).on("click", _this.change);
    };
    _this.change = function()
    {
        _type = $(this).attr('data-type');
        _this.setCCId(_type);
        $(_block).removeClass("selected");
        $(_block + '[data-type=' + _type + ']').addClass('selected');

        _parent.setupRoomList.updateRooms();
    };
}
