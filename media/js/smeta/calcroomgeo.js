/*
 *  Ползунок высота потолков
 *  @author 	senj
 * @version 1.0
 */
function CalcRoomGeo($parent)
{ 
    var _this = this;
    var _parent = $parent;

    _this.changeGeo = function() {
        _this.setGeo($(this).val());
    };
    _this.setGeo = function(city_id) {
        if(city_id !== '') {            
            _parent.rooms.geo_id = city_id;
        }else{
            console.log('Город не определен, значит будет Москва )');
        }
        _parent.calcRoomPartner.loadPartner();
    };
    _this.getGeo = function() {
        return _parent.rooms.geo_id;
    };

    _this.init = function()
    {
        // переключение стран
        $("#rus_flag").on("click", function() { $("#uk_select").hide().removeClass('active'); $("#rus_select").show().addClass('active');});
        $("#uk_flag").on("click", function() { $("#rus_select").hide().removeClass('active'); $("#uk_select").show().addClass('active');});
        
        if($('#rus_select').hasClass('active')){
            _this.setGeo($('#rus_select select').val());
        }else if($('#uk_select.active').hasClass('active')){
            _this.setGeo($('#uk_select select').val());
        }
        // выбор города
        $('.select-geo').on("change",  _this.changeGeo);
    };
//
//    
//    _this.format_number = function($value)
//    {
//        return $value.toFixed(2) || 0;
//    }
}