/*  эконом, бизнес, премиум
 * 
 * @author 	senj
 * @version 1.0
 */
function CalcRemontEBP($parent)
{
    var _parent = $parent;
    var _this = this;
    var _block = '#budget_repair_estimate-type_and_rate .budget_repair_estimate-rate dd:eq(0)';
    var _ebps = {
        'Эконом': 1,
        'Стандарт': 2,
        'Премиум': 3
    };
    
    /**
     * 
     * @returns {true}
     */
    _this.init = function()
    {
        _this.setEBPId($(_block).text());
        return true;
    };
    _this.getEBPId = function()
    {
        return _parent.rooms.repair_ebp;
    };
    
    /**
     * @param {String} $type
     * 
     * @returns {number}
     */
    _this.setEBPId = function($type)
    {
        _parent.rooms.repair_ebp = _ebps[$type];
    };
}
