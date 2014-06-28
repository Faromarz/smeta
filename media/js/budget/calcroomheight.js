/*
 *  Высота потолков
 *  
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent
 */
function CalcRoomHeightModific($parent){

    var _parent = $parent;
    var _this = _parent.calcRoomHeight;

    _this.updateHeight = function(){
         $('#smeta_ceiling #input_ceiling').val(_this.getHeight().toFixed(2).replace(/\./, ","));
         $('.budget_repair_estimate-type dd:eq(1)').text(_this.getHeight().toFixed(2).replace(/\./, ","));
    };

}