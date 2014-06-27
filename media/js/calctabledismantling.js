/**
 * Main calculator class
 *
 * @version 1.0
 */
function CalcTableDismantling ($parent) 
{
	var _parent	= $parent;
	var table	= {};
	
	var _this 	= this;
        var country = $('#table_country').val();
        var region = Number($('#table_'+country).val());
        
        var _url = "/load/workall";
        var _data = {work: 0,'city':3 };
        
        var proc	= {
            "w_d_calc-price-group-econom"	: function (_i) {
//                if(table[_i].user_id != null) {
                    return  (Number(table[_i].price_econom));
//                }else{
//                    return  (Number(table[_i].price)-Number(table[_i].price)*20/100)*Number(region);                    
//                } 
        },
            "w_d_calc-price-group-business"	: function (_i) {
//                 if(table[_i].user_id != null) {
                    return  (Number(table[_i].price_business));
//                }else{
//                    return (Number(table[_i].price))*Number(region);                    
//                } 
            },
            "w_d_calc-price-group-premium"	: function (_i) {
//                if(table[_i].user_id != null) {
                    return  (Number(table[_i].price_premium));
//                }else{
//                    return (Number(table[_i].price)+Number(table[_i].price)*50/100)*Number(region);                 
//                } 
         }
	};
	_this.user_eneble 	= false,
        _this.time_all = 0,
	_this.init = function () 
	{
            $(document).on("click", "#calc-table-dismantling-end", _this.see_all);// показать еще
                var country = $('#table_country').val();
                var region = $('#table_'+country+' option:checked').attr('data-id');
                var city = $('#region_'+region+' option:checked').attr('data-id');
                if(city  == undefined)city = 0;
                _data = {  work: 0,city:city};
                
                
                var _callback = function(data){
                    if (table == undefined) table = {};
                    table = data;
                    for(var key in table){
                        table[key]['id'] = eval(table[key]['id']);
                        table[key]['price'] = eval(table[key]['price'])*region;
                        if(table[key]['room_id'] != null)
                            table[key]['room_id'] = table[key]['room_id'].split(',');
                        else
                            table[key]['room_id'] = [];
                        
                        if(table[key]['remontType'] != null)
                            table[key]['remontType'] = table[key]['remontType'].split(',');
                        else
                            table[key]['remontType'] = [];
                        
                        if(table[key]['remontTypeDef'] != null)
                            table[key]['remontTypeDef'] = table[key]['remontTypeDef'].split(',');
                        else 
                            table[key]['remontTypeDef'] = [];
                        
                        if(table[key]['categor_arr'] != null)
                            table[key]['type_id'] = table[key]['categor_arr'].split(',');
                        else
                            table[key]['type_id'] = [];
                        
                        table[key]['enable'] = true;
                        table[key]['enable_user'] = 0;
                        
                        var countAll = 0;
                        for(var i in _parent.calcRoomList){
                            if($.inArray(_parent.calcRoomList[i].getType(), [1,2,3,4,5]) != -1){
                                table[key]['count_user_room_'+_parent.calcRoomList[i].getId()] = false;
                                if($.inArray(''+_parent.calcRoomList[i].getType()+'', table[key]['room_id']) != -1 || $.inArray(_parent.calcRoomList[i].getType(), table[key]['room_id']) != -1){
                                    var count = table[key]['count'];
                                    var new_count = '';
                                    if(count.indexOf('S') + 1){
                                        new_count = count.replace("S", "Number(_parent.calcRoomSize.getRoomSizeOne(types, false, id))");
                                    }else if(count.indexOf('CD') + 1){
                                        new_count = count.replace("CD", "Number(_parent.calcRoomSize.getCountDoorInRoom(id))");
                                    }else if(count.indexOf('CW') + 1){
                                        new_count = count.replace("CW", "Number(_parent.calcRoomSize.getCountWindowsInRoom(types))");
                                    }else if(count.indexOf('C') + 1){
                                        new_count = count.replace("C", "Number(_parent.calcRoomSize.getCountRoom(types, id))");
                                    }else if(count.indexOf('PW') + 1){
                                        new_count = count.replace("PW", "Number(_parent.calcRoomSize.getPerimeterWall(id))");
                                    }else if(count.indexOf('P') + 1){
                                        new_count = count.replace("P", "Number(_parent.calcRoomSize.getPerimeterId(id))");
                                    }else{
                                        new_count = count;
                                    }
                                    table[key]['count_room_'+_parent.calcRoomList[i].getId()] = eval("(function(types, id){return "+new_count+";})");
                                    
                                    countAll = countAll+'+'+new_count;
                                    
                                }else{
                                    table[key]['count_room_'+_parent.calcRoomList[i].getId()] = function(){return 0;}
                                }
                            }
                        }
                         table[key]['countAll'] = eval("(function(types){return "+countAll+";})");
                    }
                    _this.update();
                };
                $.extend(_data);
                $.get(_url, _data, _callback, "json");

		_this.onChangePrice();
		$('#show_dismantling').on('click', _this.toggle);
	};
        
	_this.update = function () 
	{
//		if (_parent.calcRemontType.isEnableDismantling() == false)
//			return false;
                var sho = $('.dem_show').is(':visible'); 
		var _list = _this.getList();
		$("#calc-table-dismantling>table>tbody").empty().append(_list);
                if(sho)   $('.dem_show').show(); 
              
	};

	// Показать таблыцу
	_this.see_all = function () {
            if(!$('.dem_show').is(':visible')){
                    $('#dismantling-show').text('<< Скрыть >>');
                    $('.dem_show').show();
                    $('#show_dismantling').text('+');
                    $('.count-dismantling').hide();
            }else{
                    $('#dismantling-show').text('>> Показать ещё <<');
                    $('.dem_show').hide();
                    $('#show_dismantling').text('-');
                    $('.count-dismantling').show();
                    document.location.href = '#remont';
            }
        }
	_this.show = function () 
	{
		_this.update();
		$("#calc-table-dismantling-end").show();
		$("#calc-table-dismantling").show();
		$("#str-calc-table-work").show();
		$(".dem_show").show();
                $('#show_dismantling').text('-');

	};
	_this.toggle = function()
	{                
		if ($('#show_dismantling').text() == '-'){
			_this.hide();
			$('#show_dismantling').text('+');
                        $("#calc-table-dismantling-end").hide();
                        $('.count-dismantling').show();
		}else{
			_this.show();
			$('#show_dismantling').text('-');
                        $("#calc-table-dismantling-end").show();
                        $('#dismantling-show').text('<< Скрыть >>');
                        $('.count-dismantling').hide();
		}
	};


	// Информация для граббера
	_this.getTableData = function ()
	{
		var _data = [], _i;
		var _id, _enable, _count_1,_count_2,_count_3,_count_4,_count_5,_count_6,_count_7,_count_8,_count_9, _name, _price, _priceAll;
                var typ = $('#cacl-work-demon-group .active_econom').attr('id');
		for(_i in table){
			if (!table[_i].enable)
				continue;

			_id 	= table[_i].id;
			_enable = table[_i].enable;
                        console.log(_enable);
			_name 	= table[_i].name;
                        _count_1 =  table[_i]['count_user_room_1'] === false ? table[_i]['count_room_1']([1],[1])  : table[_i]['count_user_room_1'];
                        _count_2 =  table[_i]['count_user_room_2'] === false ? table[_i]['count_room_2']([1],[2])  : table[_i]['count_user_room_2'];
                        _count_3 =  table[_i]['count_user_room_3'] === false ? table[_i]['count_room_3']([1],[3])  : table[_i]['count_user_room_3'];
                        _count_4 =  table[_i]['count_user_room_4'] === false ? table[_i]['count_room_4']([1],[4])  : table[_i]['count_user_room_4'];
                        _count_5 =  table[_i]['count_user_room_5'] === false ? table[_i]['count_room_5']([1],[5])  : table[_i]['count_user_room_5'];
                        _count_6 =  table[_i]['count_user_room_6'] === false ? table[_i]['count_room_6']([2],[6])  : table[_i]['count_user_room_6'];
                        _count_7 =  table[_i]['count_user_room_7'] === false ? table[_i]['count_room_7']([3],[7])  : table[_i]['count_user_room_7'];
                        _count_8 =  table[_i]['count_user_room_8'] === false ? table[_i]['count_room_8']([4],[8])  : table[_i]['count_user_room_8'];
                        _count_9 =  table[_i]['count_user_room_9'] === false ? table[_i]['count_room_9']([5],[9])  : table[_i]['count_user_room_9'];
                                 
			_price 	= number_format(proc[typ](_i), 0, ".", " ");

			_data.push({
				id	: _id,
				enable 	: _enable,
				name 	: _name,
				unit 	: table[_i]['unit'],
				user_id 	: table[_i]['user_id'],
				count_room_1	: _count_1,
				count_room_2	: _count_2,
				count_room_3	: _count_3,
				count_room_4	: _count_4,
				count_room_5	: _count_5,
				count_room_6	: _count_6,
				count_room_7	: _count_7,
				count_room_8	: _count_8,
				count_room_9	: _count_9,
				price	: _price
			});
		}

		return _data;
	};

	// Атоматически скрыть таблыцу
	_this.autoHide = function (event) 
	{
		var _target = event.target || this;

		if ( $(_target).parents("#calc-table-dismantling").length == 0 )
		{
                    _this.hide();
                    $(document).off("click", _this.autoHide);
		}
	}
	// Скрить таблыцу
	_this.hide = function () 
	{
            _this.update();
		$("#calc-table-dismantling").hide();
		$("#calc-table-dismantling-end").hide();
                $(".dem_show").hide();
                if ( !$("#calc-table-installation").is(':visible'))$("#str-calc-table-work").hide();
                $('#show_dismantling').text('+');
	};

	_this.getList = function () 
	{
            _this.time_all = 0;
            var dis = '';
            var tr_numb = 0;
                var chas = 0;
                var num = 1;
		var _list = [];
		var _i, _total = 0;
		var _id, _enable, _count, _name, _price, _priceAll;
                var typ = $('#cacl-work-demon-group .active_econom').attr('id');
                var room_title = '';
                // Пробелма в IE7
                 for(var room in _parent.calcRoomList){
                    if( _parent.calcRoomList[room].enable() && $.inArray(_parent.calcRoomList[room].getType(), [1,2,3,4,5]) != -1){
                        if(_parent.calcRoomList[room].getType() == 1){
                            room_title += 'К№'+_parent.calcRoomList[room].getId()+' '; 
                        }else{
                            room_title += _parent.calcRoomList[room].getTitle()+' ';                              
                        }
                        }
                    }
                     $('.work_room').html(room_title);
                                 
                if($('#class_r').val())
                    typ = $('#class_r').val();
		for (_i in table){
                    if(table[_i].nv_vt !== null && _parent.calcRemontOld.getRemontType() != Number(table[_i].nv_vt) && !_this.user_eneble){
                        table[_i].enable = false;
                            continue;
                    }
                        if(_i == 1 && !$('#calc-room-enable-9').prop("checked")){ 
                            table[_i].enable = false;
                            continue;
                        }
                        // проверка на комнаты
                        var show_in_room = false;
                         if(table[_i].room_id == ''){
                            show_in_room = true;                             
                         }else{
                            for(var room in _parent.calcRoomList){
                                if( _parent.calcRoomList[room].enable() && $.inArray(''+_parent.calcRoomList[room].getType()+'', table[_i].room_id) != -1){
                                        if(table[_i].type_id[0] != ''){
                                            for(var key in table[_i].type_id){
                                               if($('#calc-material-'+_parent.calcRoomList[room].getId()+'-'+Number(table[_i].type_id[key])).prop("checked")){
                                                    show_in_room = true;
                                                }
                                            }
                                        }else{
                                            show_in_room = true;
                                        }
                                    }
                                }
                         }
                        if(!show_in_room){
                            table[_i].enable = false;
                            continue;
                        }else{
                            if(table[_i].enableuser)
                                table[_i].enable = true;
                            else 
                                table[_i].enable = false;
                        }
                         // двери     
                        if((_i == 2 || _i == 3) && !$('#calc-room-enable-9').prop("checked") && !$('#calc-room-enable-9').prop("checked")){ table[_i].enable = false;continue;}
                        // окна
                        if((_i == 5 || _i == 6 || _i == 7) && !$('#calc-room-enable-8').prop("checked")){ table[_i].enable = false;continue;}
                        
                        if (
                                (   
                                    $.inArray(_parent.calcRemontPrice.getGroup(), table[_i].remontType) != -1
                                    &&
                                    $.inArray(_parent.calcRemontType.getRemontType(), table[_i].remontType) != -1
                                )||(
                                    $.inArray(_parent.calcRemontPrice.getGroup(), table[_i].remontTypeDef) != -1
                                    &&
                                    $.inArray(_parent.calcRemontType.getRemontType(), table[_i].remontTypeDef) != -1
                                )
                                    && 
                            (
                                _parent.calcRemontPrice.getGroup()!= ''
                                &&
                                _parent.calcRemontType.getRemontType() != ''
                            )
                            )
			{
				_id 	= table[_i].id;
				_enable = table[_i].enable;
                                if(_i == 1 ){
                                    var type_id = '';
                                    if (_parent.calcRoomSize.getLengthRoom([6])>=0.9   &&  _parent.calcRoomSize.getLengthRoom([6])<=1.6 && _parent.calcRoomSize.getWidthRoom([6])>=0.4   && _parent.calcRoomSize.getWidthRoom([6])<=1.0){ type_id=33;}
                                    else if (_parent.calcRoomSize.getLengthRoom([6])>1.6    &&  _parent.calcRoomSize.getLengthRoom([6])<=2.3 && _parent.calcRoomSize.getWidthRoom([6])>=0.4   && _parent.calcRoomSize.getWidthRoom([6])<=1.0){ type_id=34;}
                                    else if (_parent.calcRoomSize.getLengthRoom([6])>=0.9   &&  _parent.calcRoomSize.getLengthRoom([6])<=1.6 && _parent.calcRoomSize.getWidthRoom([6])> 1     && _parent.calcRoomSize.getWidthRoom([6])<=1.7){ type_id=35;}
                                    else if (_parent.calcRoomSize.getLengthRoom([6])> 1.6   &&  _parent.calcRoomSize.getLengthRoom([6])<=2.3 && _parent.calcRoomSize.getWidthRoom([6])> 1     && _parent.calcRoomSize.getWidthRoom([6])<=1.7){ type_id=36;}
                                    else if (_parent.calcRoomSize.getLengthRoom([6])>=0.9   &&  _parent.calcRoomSize.getLengthRoom([6])<=1.6 && _parent.calcRoomSize.getWidthRoom([6])> 1.7   && _parent.calcRoomSize.getWidthRoom([6])<=2.7){ type_id=37;}
                                    else if (_parent.calcRoomSize.getLengthRoom([6])> 1.6   &&  _parent.calcRoomSize.getLengthRoom([6])<=2.3 && _parent.calcRoomSize.getWidthRoom([6])> 1.7   && _parent.calcRoomSize.getWidthRoom([6])<=2.7){ type_id=38;}
                                    if(!$('#calc-material-1-'+type_id).prop("checked")
                                            && !$('#calc-material-2-'+type_id).prop("checked")
                                            && !$('#calc-material-3-'+type_id).prop("checked")
                                            && !$('#calc-material-4-'+type_id).prop("checked")
                                            && !$('#calc-material-5-'+type_id).prop("checked")
                                    )_enable = false; else _enable = true;
                                    
                                } 
                                if((_i == 2||_i == 3)
                                        && !$('#calc-material--1-5').prop("checked")
                                        && !$('#calc-material--1-6').prop("checked"))_enable = false; else _enable = true;
                                if(_i == 4 && !$('#calc-material-1-32').prop("checked")
                                        && !$('#calc-material-2-32').prop("checked")
                                        && !$('#calc-material-3-32').prop("checked")
                                        && !$('#calc-material-4-32').prop("checked")
                                        && !$('#calc-material-5-32').prop("checked"))_enable = false; else _enable = true;
                                if(_i == 5 && !$('#calc-room-enable-4').prop("checked") && !$('#calc-material-4-17').prop("checked"))_enable = false; else _enable = true;
                                if(_i == 6 && !$('#calc-room-enable-4').prop("checked") && !$('#calc-material-4-19').prop("checked"))_enable = false; else _enable = true;
                                if(_i == 7 && !$('#calc-room-enable-4').prop("checked") && !$('#calc-material-4-21').prop("checked"))_enable = false; else _enable = true;
                                if(_i == 8 && !$('#calc-material--1-23').prop("checked"))_enable = false;else _enable = true;
                                if(_i == 9 && _total < table[_i].price)_enable = false; else _enable = true;
                             
				_name 	= table[_i].name;
				_price 	= proc[typ](_i);
                                if(!$('#calc-remont-dismantling').prop("checked") && !_this.user_eneble){
                                    _enable = false;
                                }
                                if(table[_i]['enable_user'] === false ||table[_i]['enable_user'] === true)
                                    _enable = table[_i]['enable_user'];
				
                                if(tr_numb == 3){
                                    dis = ' class="dem_show"';
                                }else{
                                    tr_numb++;
                                }
				// HTML
				_list += "<tr"+dis+">";
				_list += "<td><input id='calc-dismantling-enable-"+_id+"' name=\"\" value=\""+_id+"\" type='checkbox' "+(_enable ? "checked='cheched'" : "")+"><label for='calc-dismantling-enable-"+_id+"' style='margin-top:0;'></label></td>";
                                _list += "<script>";
                                        _list += '$("#calc-dismantling-enable-'+_id+'").change(calcRemontType.getTableDismantling().onChangeEnable);';
                                    _list += "</script>";
				_list += "<td>"+num+"</td>";
                                num++;
				_list += "<td>" + _name + "</td>";
				_list += "<td id='calc-dismantling-unit-"+_id+"' align=\"right\">" + table[_i]['unit'] + "</td>";
				_list += "<td id='calc-dismantling-price-"+_id+"' align=\"right\">" + _price + "</td>";
                                _list += "<td align=\"center\">";
                                var countAll = 0;
                                for(var i in _parent.calcRoomList){
                                    if(_parent.calcRoomList[i].enable() && $.inArray(_parent.calcRoomList[i].getType(), [1,2,3,4,5]) != -1){
                                        // Пробелма в IE7
                                        var _count =  table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] === false ? table[_i]['count_room_'+_parent.calcRoomList[i].getId()]([_parent.calcRoomList[i].getType()],[_parent.calcRoomList[i].getId()])  : table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()];
                                        if(_count != undefined && _count != 0){
                                            countAll += Number(_count);
                                            _list += "<input class='input_filter"+(table[_i]['unit'] == 'шт.'?"_int":"")+"' data-room='"+_parent.calcRoomList[i].getId()+"' id='calc-dismantling-count-"+_id+"-"+_parent.calcRoomList[i].getId()+"' value='"+ number_format( _count, (table[_i]['unit'] == 'шт.'?0:2), ".", "") +"' data-index='"+_id+"' >";
                                        }else{
                                            _list += "<input class='input_filter' data-room='"+_parent.calcRoomList[i].getId()+"' id='calc-dismantling-count-"+_id+"-"+_parent.calcRoomList[i].getId()+"' value='-' data-index='"+_id+"' >";
                                        }
                                                // Scripts
                                        _list += "<script>";
                                                _list += '$("#calc-dismantling-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").keyup(calcRemontType.getTableDismantling().onKeyUpPrice);';
                                                _list += '$("#calc-dismantling-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").change(calcRemontType.getTableDismantling().onChangePrice);';
//                                                _list += '$("#calc-dismantling-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").inputmask("decimal", { groupSeparator : "", digits: 2, radixPoint: "." });'; 	// Init input mask
                                        _list += "</script>";
                                    }       
                                }
                                _priceAll = _enable == false ? 0 :  Number(countAll)*Number(_price);
                                _list += "</td>";
                                _list += "<td align=\"center\"><input value='"+ number_format( countAll, (table[_i]['unit'] == 'шт.'?0:2), ".", "") +"'  disabled /></td>";
                                _list += "<td align=\"center\"><input value='"+ number_format(Number(countAll)*Number(table[_i]['watch']),1, ".", "") +"'  disabled /></td>";
                                if(_enable)chas += Number(countAll)*Number(table[_i]['watch']);
				_list += "<td id='calc-dismantling-price-all-"+_id+"' align=\"right\">" +number_format(Math.ceil(_priceAll),0,'.',' ') + "</td>";
				_list += "</tr>";

//                                        _list += "<script>";
//                                                _list += '$("#calc-dismantling-enable-'+table[_i].id+'").click(calcRemontType.getTableDismantling().onChangeEnable);';
//                                        _list += "</script>";
				

				// If service if enable. then increment total price
                                table[_i].enable = _enable;
				if ( _enable )
                                    _total += Math.ceil(_priceAll);
			}
                        
		};

		// If items is empty then echo Empty line
		if (_list.length == 0) {
                    _list += "<tr><td colspan=\"7\"><i>Для этих параметров ремонта нет услуг</i></td></tr>";
                    if(!_this.user_eneble && _parent.calcRemontOld.getRemontType() == 0){
//                        if($('#calc-remont-typ-novo').hasClass('remont_active')) $('#calc-remont-dismantling').next().hide();
                        $('#calc-remont-dismantling').attr('checked', false);
                        $('#calc-remont-dismantling1').attr('checked', false);
                    }
                    
                }
                _this.time_all = chas;
		// Total price number_format(Math.ceil(proc[typ](_i)/100)*100,0,'.',' ')
		_list += "<tr class=\"dem_show\"><td></td><td></td><td></td><td></td><td></td><td></td><td align=\"center\"><b>ИТОГО:</b></td><td></td><td align=\"right\">" +number_format(Math.ceil(_total/100)*100,0,'.',' ') + " </td></tr>";

		// Update price
		_parent.calc.setPriceDismantling( _total );
//                 if($('#calc-remont-groups li a').hasClass('remont_active') && $('#cacl-price-group li').hasClass('active_econom')){
////                    $('#help_count').empty();
//                }

		$(_list).find("td>input").each(function () {
			
		});
                $('.count-dismantling').text('Всего '+(num-1) +' '+declOfNum(num-1,['работа','работы','работ']));
		return _list;
	}


	/** 
	 * On change enable of service in desmanting services
	 *
	 */
	_this.onChangeEnable = function (e) 
	{
		e.preventDefault();
		var _id = parseInt(this.value);
		var _enable = this.checked;
                for(_i in table){
                    if (table[_i]['id'] == _id){
                        table[_i].enable_user = _enable;
                    }
                }
                _this.update();
		return false;
	}

	_this.onKeyUpPrice = function () 
	{
		var _id   = $(this).attr("data-index");
		var _i;

		for(_i in table){
			if (table[_i]['id'] == _id){
				table[_i]['count_user_room_'+$(this).attr('data-room')] = $(this).val().replace(/\,/, ".");
				break;
			}
		}
	}


	_this.onChangePrice = function () 
	{
		_this.update();
	}

}
