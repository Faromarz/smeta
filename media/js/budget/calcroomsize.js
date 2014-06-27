/**
 * Площадь комнат
 *
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent
 */
function CalcRoomSizeModific($parent)
{
    var _parent = $parent;
    var _this = _parent.calcRoomSize;

    _this.update = function() {
        // обновить общую площадь
        _this.updateRoomSize([1, 2, 3, 4, 5]);
        // обновить надпись количество комнат
        _parent.setupRoomList.updateName();
        // обновить площадь
        $('#dop_options_footer_rezult h3').text(_this.getSize().toFixed(2).replace(/\./, ",") + '  м²');
        $('.budget_repair_estimate-type dd:eq(0)').text(_this.getSize().toFixed(2).replace(/\./, ",") + '  м²');
        // обновить материалы (цену)
        _parent.setupRoomList.update();
    };
}