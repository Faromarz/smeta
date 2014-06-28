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
    var _block = '#budget_repair_estimate-type_and_rate .budget_repair_estimate-rate dd:eq(1)';
    var _cc = {
        'Косметический':4,
        'Капитальный':5
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
        _this.setCCId($(_block).text());
    };
}
