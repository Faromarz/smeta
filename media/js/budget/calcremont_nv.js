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
    var _block = '#budget_repair_estimate-type_and_rate .budget_repair_estimate-rate dd:eq(2)';
    var _nv = {
        'Новострой' : 6,
        'Вторичка': 7
    };
    _this.getNVId = function() {
        return _parent.rooms.repair_nv;
    };
    _this.setNVId = function($type) {
        _parent.rooms.repair_nv = _nv[$type];
    };
    _this.init = function()
    {
        _this.setNVId($(_block).text());
    };
}
