/*  эконом, бизнес, премиум
 * 
 * @author 	senj
 * @version 1.0
 */
function CalcRemontEBP($parent)
{
    var _parent = $parent;
    var _this = this;
    var _block = '#order_options_rate li';
    var _block_2 = '#choose_rate li';
    var _type = 'standart';
    var _ebps = {
        'econom': 1,
        'standart': 2,
        'premium': 3
    };
    
    /**
     * 
     * @returns {unresolved}
     */
    _this.change = function() {
        _type = $(this).attr('data-type');
        _this.setEBPId(_type);
        $(_block).removeClass("selected");
        $(_block_2).removeClass("choose_rate_selected");
        $(_block + '[data-type=' + _type + ']').addClass('selected');
        $(_block_2 + '[data-type=' + _type + ']').addClass('choose_rate_selected');


        if (_type === 'econom') {
            $("#examples_works_slider_standart").children('div').fadeOut(400, function() {
                $("#examples_works_slider_standart").hide();
            });
            $("#examples_works_slider_premium").children('div').fadeOut(400, function() {
                $("#examples_works_slider_premium").hide();
            });
        } else if (_type === 'standart') {
            $("#examples_works_slider_econom").children('div').fadeOut(400, function() {
                $("#examples_works_slider_econom").hide();
            });
            $("#examples_works_slider_premium").children('div').fadeOut(400, function() {
                $("#examples_works_slider_premium").hide();
            });
        } else if (_type === 'premium') {
            $("#examples_works_slider_standart").children('div').fadeOut(400, function() {
                $("#examples_works_slider_standart").hide();
            });
            $("#examples_works_slider_econom").children('div').fadeOut(400, function() {
                $("#examples_works_slider_econom").hide();
            });
        }
        $("#examples_works_slider_" + _type).children('div').show();
        setTimeout(function() {
            $("#examples_works_slider_" + _type).show(function() {
                $("#examples_works_slider_" + _type).children('div').fadeIn();
            });
        }, 500);
        _parent.setInitCategory(true);
        
        return _parent.setupRoomList.updateRooms();
    };
    
    /**
     * 
     * @returns {true}
     */
    _this.init = function()
    {
        $(_block + '[data-type=' + _type + ']').addClass('selected');
        $(_block_2 + '[data-type=' + _type + ']').addClass('choose_rate_selected');
        $(_block).on("click", _this.change);
        $(_block_2).on("click", _this.change);
        
        return true;
    };
    _this.getEBP = function()
    {
        return _type;
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
