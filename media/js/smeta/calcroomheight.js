/*
 *  Высота потолков
 *  
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent
 */
function CalcRoomHeight($parent)
{
    var _this = this;
    var _parent = $parent;
    var min_height = 1.50;
    var max_height = 4.00;
    var step = 0.10;
    
    _this.getStep = function(){
        return step;
    };
    _this.getMinHeight = function(){
        return min_height;
    };
    _this.getMaxHeight = function(){
        return max_height;
    };
    _this.getHeight = function() {
        return _parent.rooms.height;
    };
    _this.setHeight = function($height) {
        var _height = $height;
        _height = _height < _this.getMinHeight() ? _this.getMinHeight() : _height;
        _height = _height > _this.getMaxHeight() ? _this.getMaxHeight() : _height;
        _parent.rooms.height = _height;
        
        _this.updateHeight();
    };
    _this.updateHeight = function(){
         $('#smeta_ceiling #input_ceiling').val(_this.getHeight().toFixed(2).replace(/\./, ","));
    };
    _this.changeHeight = function($type){
        if($type){
            _this.setHeight(_this.getHeight() - _this.getStep() < _this.getMinHeight() ? _this.getMinHeight() : _this.getHeight() - _this.getStep());
        }else{
            _this.setHeight(_this.getHeight() + _this.getStep() > _this.getMaxHeight() ? _this.getMaxHeight() : _this.getHeight() + _this.getStep());
        }
        _parent.setInitCategory(true);
         _parent.calcRoomSize.update();
    };
   
    _this.init = function()
    {
        _this.setHeight(Number(str_replace(',','.',$('#smeta_ceiling #input_ceiling').val())));
        $('#smeta_ceiling .button_minus').on('click', function() {    _this.changeHeight(true);    });
        $('#smeta_ceiling .button_plus').on('click', function() {     _this.changeHeight(false);    });
        $('#smeta_ceiling #input_ceiling').on('change', function() {  _this.setHeight(Number($(this).val().replace(/\,/, ".")));  });
    };
//
//    
//    _this.format_number = function($value)
//    {
//        return $value.toFixed(2) || 0;
//    }
}