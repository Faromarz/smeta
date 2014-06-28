/**
 * Площадь комнат
 *
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent description
 */
function CalcRoomSize($parent)
{
    var _this = this;
    var _parent = $parent;

    _this.setSize = function($size) {
        _parent.rooms.size = $size;
    };
    _this.getSize = function() {
        return _parent.rooms.size;
    };
     // Площа комнат
    _this.updateRoomSize = function($types) {
        var _types = $types || [1];
        var _i, _size = 0;
        for (_i in _parent.rooms.room) {
            if (_parent.rooms.room[_i].getEnable() === true && in_array(_parent.rooms.room[_i].getType(), _types)) {
                _size += Number(_parent.rooms.room[_i].getSize());
            }
        }
        _this.setSize(_size);
    };
    _this.update = function() {
        // обновить общую площадь
        _this.updateRoomSize([1, 2, 3, 4, 5]);
        // обновить надпись количество комнат
        _parent.setupRoomList.updateName();
        // обновить площадь
        $('#dop_options_footer_rezult h3').text(_this.getSize().toFixed(2).replace(/\./, ",") + '  м²');
        // обновить материалы (цену)
        _parent.setupRoomList.update();
    };
    _this.init = function() {
        console.log('Обновление инфо о комнатах (все выкл)');
//                        _this.update();
    };


//    _this.calculate = function() {
//
//        // Материалы
////		_parent.calcRemontType.getTableDismantling().update();
////		_parent.calcRemontType.getTableInstallation().update();
////                                _parent.calc.update();
//   
//    };
//	// Информация о комнатах ( передаем в смету) граббера
//	_this.getRoomsData = function () 
//	{
//		var _data = [], _i;
//		for(_i in rooms){
//                    
//                    if ( !rooms[_i].enable() || $.inArray(rooms[_i].getType(), [-1,1,2,3,4,5,6,7,8,9]) == -1)
//                        continue;
//
//                    _data.push({
//                        room_group 	: $('#cacl-price-group .active_econom').attr('data-group'),// класс ремонта
//                        room_id 	: rooms[_i].getId(),// id комнаты
//                        room_type	: rooms[_i].getType(),
//                        room_title 	: rooms[_i].getTitle(), // название комнаты
//                        room_S          : rooms[_i].getSize(), // площадь комнаты
//                        room_P          : rooms[_i].getPerimeter(), // периметр комнаты
//                        room_H          : $("#calc-height").val(), // высота комнаты
//                        room_balcon	: rooms[_i]['balcon'] ? rooms[_i]['balcon']() : false, // площадь балкона
//                        
//                        room_window_count   :_this.getCountWindowsInRoom([rooms[_i].getType()]), // количество окна в комнате
//                        room_window_L   : Number(_this.getLengthRoom([8])), // высота окна
//                        room_window_W   : Number(_this.getWidthRoom([8])), // шинира окна
//                        room_window_size    :rooms[5].getSize(), // площадь окон
//                        room_window_type    : $('#cacl-price-window .active_premium').attr('data-id'), // тип окна
//                        
//                        room_country    : $('#table_country').attr('data-id'), // страна
//                        room_region    :  $('#table_'+$('#table_country').val()+' option:selected').attr('data-id'), // страна
//                        room_city    : $('#region_'+$('#table_'+$('#table_country').val()+' option:selected').attr('data-id')+' option:selected').attr('data-id'), // страна
//                        room_coeff    : $('#table_'+$('#table_country').val()).val(), // страна
//                        
//                        
//                        room_door_count	: _this.getCountDoorInRoom([rooms[_i].getType()]),
//                        room_door_W     : _this.getWidthRoom([10]), // шинира двери
//                        room_door_size	:   rooms[_i].getType() == 3 ? rooms[9].getSize():rooms[10].getSize()                        
//                    });
//		}
//                return _data;
//	};
//	_this.getInfoData = function () 
//	{
//		var _data = [], _i;
//		
//                    _data.push({
//                        count_room 	: _parent.setupRoomLis.getroom(),
//                        calcremonttype 	: _parent.calcRemontType.getRemontType(),
//                        calcremontprice : _parent.calcRemontPrice.getGroup(),
//                        calcremontold : _parent.calcRemontOld.getRemontType(),
//                        size_room : size
//                                              
//                    });
//		
//                return _data;
//	};
//
//         // Get Count Door In Room (!)
//	 _this.getCountDoorInRoom = function (id) {
//             if($.isArray(id))id = id[0];
//	 	var _count = 0;
//                if(id == 3)
//                    _count = Number($('#calc-room-count-8').text())-Number(_parent.calcRoomSize.getCountRoom([1,2,4,5]))+1;
//                else if($.inArray(id, [1,2,3,4,5,7,9]) != -1)
//                    _count = 1;
//	 	return _count;
//	 }
//         
//         // Get Count Windows In Room (!)
//	 _this.getCountWindowsInRoom = function (type) {
//              if($.isArray(type))type = type[0];
//	 	var _count = 0;
//                if(type == 1)
//                    _count = Number($('#calc-room-count-6').text())-Number(_parent.calcRoomSize.getCountRoom([1,2]))+1;
//                else if($.inArray(type, [-1,2]) != -1)
//                    _count = 1;
//	 	return _count;
//	 }
//        
//	// Get all door (!)
//	_this.getCountDoor = function (){
//		var _count = 0;
//                _count = Number($('#calc-room-count-8').text());
//		return _count;
//	}
//
//	// Count all windows (!)
//	 _this.getCountWindow = function () {
//                var _count = 0;
//	 	_count = Number($('#calc-room-count-6').text()) || 0;
//	 	return _count;
//	 }
//                  
//        // Get Length of room (!)
//        _this.getLengthRoom = function (types){
//            var _types = types || [1,2,3,4,5,6,7,8]
//            var _length = 0;
//            var _roomList = _parent.rooms;
//
//            for (_i = _roomList.length - 1; _i >= 0; _i--){
//                if ( _roomList[_i].enable() && $.inArray(_roomList[_i].type(), _types) != -1 ){
//                    _length += _roomList[_i].getLength();
//                    break;
//                }
//            }
//            return _length;
//        };
//
//	// Get Width of room (!)
//	_this.getWidthRoom = function (type) 
//	{
//		var _width = 0;
//		var _roomList = _parent.rooms;
//		for (_i = _roomList.length - 1; _i >= 0; _i--) {
//			if ( _roomList[_i].enable() && $.inArray(_roomList[_i].type(), type) != -1 ){
//				_width += _roomList[_i].getWidth();
//				break;
//			}
//		}
//		return _width;
//	}
//        
//        // Количество комнат (!)
    _this.getCountRoom = function(types) {
        var _types = types || [1, 2];
        var _count = 0, _i;
        // Пробелма в IE7
//                            for(_i in _parent.rooms.room){
//                                    if ( _parent.rooms.room[_i].enable() == 'on'  && $.inArray(_parent.rooms.room[_i].getType(), _types) != -1 )
//                                        _count++;
//                                    }
        return _count;
    }
//
//	// Периметр стен (!)
//	_this.getPerimeterWall = function ($id){
//		var _id = $id || [1];
//		var _i, _perimeter = 0;
//                var height    = Number($('#calc-height').val()) || 2.75;
//
//		for(_i in _parent.rooms.room){
//                    if ( _parent.rooms.room[_i].enable() && $.inArray(_parent.rooms.room[_i].getId(), _id) != -1 ){
//                        if( $.inArray(_parent.rooms.room[_i].getType(), [1,2])!= -1){
//                            _perimeter += Number(_parent.rooms.room[_i].getPerimeter())*Number(height)-Number(_this.getRoomSize([6], true))-Number(_this.getRoomSize([8], true)-Number($.inArray(_parent.rooms.room[_i].getType(), [1,2]) != -1 ?_parent.rooms.room[_i].balcon()?1.6:0:0));
//                        }else if(_parent.rooms.room[_i].getType() == 3){
//                            _perimeter += Number(_parent.rooms.room[_i].getPerimeter())*Number(height)-Number(_this.getRoomSize([7], true));
//                        }else{
//                            _perimeter += Number(_parent.rooms.room[_i].getPerimeter())*Number(height)-Number(_this.getRoomSize([8]));
//                        }
//                    }
//		}
//		return _perimeter;
//	};
//	// Периметр комнат (!)
//	_this.getPerimeter = function ($types){
//		var _types = $types || [1];
//		var _i, _perimeter = 0;
//
//		for(_i in _parent.rooms.room){
//                    if ( _parent.rooms.room[_i].enable() && $.inArray(_parent.rooms.room[_i].type(), _types) != -1 ){
//                        _perimeter += _parent.rooms.room[_i].getPerimeter();
//                    }
//		}
//               
//		return _perimeter;
//	};
//	// Периметр комнат (!)
//	_this.getPerimeterId = function ($id){
//		var _id = $id || [1];
//		var _i, _perimeter = 0;
//
//		for(_i in _parent.rooms.room){
//                    if ( _parent.rooms.room[_i].enable() && $.inArray(_parent.rooms.room[_i].getId(), _id) != -1 ){
//                        _perimeter += _parent.rooms.room[_i].getPerimeter();
//                    }
//		}
//               
//		return _perimeter;
//	};
//	
//	// Площа одной комнаты (!)
//	_this.getRoomSizeOne = function ($type, $enable, $id){
//                var id = $id;
//                var _enable = $enable || false;
//		var _i, _size = 0;
//		for(_i in _parent.rooms.room){
//			if ( ( _parent.rooms.room[_i].enable() || _enable)
//                            &&
//                                _parent.rooms.room[_i].getId() == id
//                           )
//			{
//				_size += Number(_parent.rooms.room[_i].getSize());
//			}
//		}
//		return _size.toFixed(2);
//	};
//	
   
////	// Площа комнат (!)
//	_this.getRoomSizeId = function ($id, $enable){
//                var _enable = $enable || false;
//		var _id = $id || [1];
//		var _i, _size = 0;
//                // Пробелма в IE7
//		for(_i in _parent.rooms.room){
//			if ( ( _parent.rooms.room[_i].enable() || _enable)
//                            &&
//                                ($.inArray(_parent.rooms.room[_i].getId(), _id) != -1 
//                                ||
//                                $.inArray(''+_parent.rooms.room[_i].getId()+'', _id) != -1)
//                                )
//			{
//				_size += Number(_parent.rooms.room[_i].getSize());
//			}
//		}
//		return _size.toFixed(2);
//	};
}