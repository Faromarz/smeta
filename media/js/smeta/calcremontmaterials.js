/**
 * Манипуляция материалами комнат
 *
 * @author 	senj senj@mail.ru
 * @version 1.0
 *
 * @param {object} $parent
 */
function CalcRemontMaterials($parent)
{
    var _this = this;
    var _parent = $parent;

   
//    var _groups = [];
//    var _params = {};
//    var _user_check = true;
//    var count_materials_show = 0;

//    _this.get_user_eneble = function (){
//        return _user_check;
//    }
//    _this.get_count_materials_show = function (){
//        return count_materials_show;
//    }
//    _this.add_count_materials_show = function (){
//        count_materials_show++;
//    }
    
   
    _this.init = function()
    {
       
//        var price = 1.0;
//        $( ".slider-materials" ).slider({
//			min 	: 1,
//			max 	: 21,
//			orientation : 'vertical',
//			step	: 1,
//			value 	: 11,
//			create	: function (event, ui) {
//				$(".price-materials").text( price.toFixed(2));
//			},
//			stop 	: function () {
////				_parent.calcRoomSize.update();
//			},
//			slide  	: function (event, ui) {
//				$(".price-materials").text(ui.value );
//			},
//			change 	: function (event, ui) {
//				price = ui.value;
//			}
//		});
//                
//        console.log('обновление материалов');
//         console.log(_parent.rooms.room);

//        $(document).on('click', '#calc-material-all', _this.changeAll);// снятие всех галочек с материалов
//        _this.update();
//        $(document).on('click', '.show-hide-mater', _this.visibleMater);
    };
//    _this.changeAll = function () {
//            _user_check = $(this).prop('checked');
//            $('.item_material input:checked').attr('ckecked', _user_check);
//            _this.update();
//        }
//    // remove all groups
//    _this.empty = function ()
//    {
//        $(_wrap).empty();
//    };
//
   
//    _this.visibleMater = function(){
//        $('.hide_mater').toggle();
//        if($('.hide_mater').is(':visible')){
//            $('.show-hide-mater center').empty().text('<< Скрыть >>');
//            $('.count_materials').hide();
//            $('.div_plintus_perview').hide();
//            $('.div_oboi_perview').hide();
//        }else{
//            $('.show-hide-mater center').empty().text('>> Показать ещё <<'); 
//            $('.count_materials').show();
//        }
//    }
//
//    // Return all enabled room, window, etc
    _this.updateRooms = function()
    {
//        var _i;
//        _groups = [];
//        count_materials_show = 0;
//
//// Пробелма в IE7
//        for(_i in _parent.rooms.room)
//            if( _parent.rooms.room[_i].enable() )
//                _groups.push(_parent.rooms.room[_i]);
//
//        return _groups;
    };
//    // Информиция о материалах для граббера
//    _this.getMaterialsData = function ()
//    {
//        var _data = [];
//        var _room_id, _material_id;
//
//        for(_room_id in Ballon.prices)
//        {
//            for(_material_id in Ballon.prices[_room_id])
//            {
//                _data.push({
//                    room_id 	: _room_id,
//                    material_id	: _material_id,
//                    price 	: Ballon.prices[_room_id][_material_id],
//                    id 		: Ballon.selected_materials[_room_id][_material_id],
////                    enables 	: Ballon.enabled[_room_id][_material_id],
//                    enables 	: false,
//                    value 	: 10
//                });
//            }
//        }
//        return _data;
//    };
//
    
}