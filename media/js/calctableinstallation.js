/**
 * Main calculator class
 *
 * @version 1.0
 */
function CalcTableInstallation ($parent) 
{
	var _parent	= $parent;
	var _this 	= this;     
	_this.eneble_cat 	= [];     
	_this.eneble_all 	= [];
        var country = $('#table_country').val();
        var region = Number($('#table_'+country).val());
        var priceAll    = function (_count, _price) { return (_count * _price ); };
        
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
        var table = new Array();
        var cat_work = new Array();
        var _url = "/load/workall";
        var _data = {  work: 1,city:3   };
       
	_this.time_all = 0,
	_this.init = function () 
	{
                $(document).on("click", "#calc-table-installation-end", _this.see_all);// показать еще
                $(document).on("click", ".calc-installation-cat", _this.eneble_c);// галочки групы
                var country = $('#table_country').val();
                var region = $('#table_'+country+' option:checked').attr('data-id');
                var region_coeff = $('#table_'+country).val();
                var city = $('#region_'+region+' option:checked').attr('data-id');
                if(city  == undefined)city = 0;
//                console.log('монтажные '+country+' '+region+' '+city);
                _data = {  work: 1,city:city};
		_this.onChangePrice();
		$('#show_installation').on('click', _this.toggle);
                
                var _callback = function(data){
                    if (table == undefined)
                        table = {};
                    table = data;
                    for(var key in table){
                        table[key]['id'] = eval(table[key]['id']);
                        table[key]['price'] = eval(table[key]['price'])*region_coeff;
                        table[key]['windows'] = false;
                        table[key]['user_count'] = false;
                        table[key]['enable_user'] = 0;
                        table[key]['enable'] = true;
                        table[key]['priceAll'] = eval(priceAll);
                        if(table[key]['remontType'] != null)      table[key]['remontTypeCosmetic'] = table[key]['remontType'].split(',');
                        else table[key]['remontTypeCosmetic'] = [];
                        if(table[key]['remontTypeDef'] != null){
                            table[key]['remontTypeCapital'] = table[key]['remontTypeDef'].split(',');
                        }else{ 
                            table[key]['remontTypeCapital'] = [];
                        }
                        if(table[key]['categor_arr'] != null){
                            table[key]['type_id'] = table[key]['categor_arr'].split(',');
                        }else{
                            table[key]['type_id'] = [];                            
                        }
                        if(table[key]['room_id'] != null){
                            table[key]['room_id'] = table[key]['room_id'].split(',');                            
                        }else{
                            table[key]['room_id'] = '';                                                        
                        }
                        if(table[key]['podceteg_arr'] == null){                           
                            table[key]['podceteg_arr'] = '';                                                        
                        }else{
                             table[key]['podceteg_arr'] = table[key]['podceteg_arr'].split(',')
                        }
                        var countAll = 0;
                        for(var i in _parent.calcRoomList){
                            if($.inArray(_parent.calcRoomList[i].getType(), [1,2,3,4,5]) != -1){
                                table[key]['count_user_room_'+_parent.calcRoomList[i].getId()] = false;
                                if($.inArray(''+_parent.calcRoomList[i].getType()+'', table[key]['room_id']) != -1){
                                    var count = table[key]['count'];
                                    var new_count = table[key]['count'];
                                    if(count.indexOf('S') + 1){
                                        new_count = count.replace("S", "Number(_parent.calcRoomSize.getRoomSizeOne(types, false, id))");
                                    }else if(count.indexOf('CD') + 1){
                                        new_count = count.replace("CD", "Number(_parent.calcRoomSize.getCountDoorInRoom(id))");
                                    }else if(count.indexOf('CW') + 1){
                                        new_count = count.replace("CW", "Number(_parent.calcRoomSize.getCountWindowsInRoom(types))");
                                    }else if(count.indexOf('C') + 1){
                                        new_count = count.replace("C", "Number(_parent.calcRoomSize.getCountRoom(types))");
                                    }else if(count.indexOf('PW') + 1){
                                        new_count = count.replace("PW", "Number(_parent.calcRoomSize.getPerimeterWall(id))");
                                    }else if(count.indexOf('P') + 1){
                                        new_count = count.replace("P", "Number(_parent.calcRoomSize.getPerimeterId(id))");
                                    }
                                    table[key]['count_room_'+_parent.calcRoomList[i].getId()] = eval("(function(types,id){return number_format("+new_count+", 2);})");
                                    
                                    countAll = countAll+'+'+new_count;
                                    
                                }else{
                                    table[key]['count_room_'+_parent.calcRoomList[i].getId()] = function(types){return 0;}
                                }
                            }
                        }
                         table[key]['countAll'] = eval("(function(types){return "+countAll+";})");
                         
                    }
                    _this.work = table;
                   
                   // добавляем работы окон
//                    var i = table.length;
//                            var _url1 = "/load/workall";
//                            var _data1 = {  work: 3 };
//                            var _callback1 = function(data1){
//              
//                            var tablel = data1;
//                            var id = 69;
//                           
//                            for(var key in tablel){
//                               for(_i in _parent.calcRoomList){                                   
//                                    var type = _parent.calcRoomList[_i].getType();
//                                    if ( type != 1 && type != 2)continue;
//                                      id++;
//                                        table[i] = [];
//                                        table[i] = {'id': id};
//                                        table[i]['room_id'] = [''+_parent.calcRoomList[_i].getId()+''];
//                                        table[i]['room_title'] = [''+_parent.calcRoomList[_i].getTitle()+''];
//                                        table[i]['name'] = eval("(function(title){return 'Окна '+title+': Поворотник + Отлив';})");
//                                        table[i]['price'] = Math.ceil(10*Number($('#calc-room-width-8').val())*tablel[key]['podokonnik_otliv']*region_coeff);
//                                        table[i]['remontTypeCosmetic'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['remontTypeCapital'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['count_user_room_1'] = false;
//                                        table[i]['count_user_room_2'] = false;
//                                        table[i]['count_user_room_3'] = false;
//                                        table[i]['count_user_room_4'] = false;
//                                        table[i]['count_user_room_5'] = false;
//                                        table[i]['count_user_room_6'] = false;
//                                        table[i]['count_user_room_7'] = false;
//                                        table[i]['podceteg_arr'] = '';
//                                        if(_parent.calcRoomList[_i].getId() == 1)
//                                            table[i]['count_room_1'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else
//                                            table[i]['count_room_1'] = function(room){return  0 ;};
//                                        
//                                        if(_parent.calcRoomList[_i].getId() == 2)
//                                            table[i]['count_room_2'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else
//                                            table[i]['count_room_2'] = function(room){return  0 ;};
//                                        
//                                        if(_parent.calcRoomList[_i].getId() == 3)table[i]['count_room_3'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_3'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 4)table[i]['count_room_4'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_4'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 5)table[i]['count_room_5'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_5'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 6)table[i]['count_room_6'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_6'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 7)table[i]['count_room_7'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_7'] = function(room){return  0 ;};
//                                        
//                                        table[i]['enableuser'] = true;
//                                        table[i]['enable'] = true;
//                                        table[i]['priceAll'] = eval(priceAll);
//                                        table[i]['type_id'] = [33,34,35,36,37,38];
//                                        table[i]['windows'] = true;
//                                        ++i;
//                                        ++id;
//                                        table[i] = [];
//                                        table[i] = {'id': id};
//                                        table[i]['room_id'] = [''+_parent.calcRoomList[_i].getId()+''];
//                                        table[i]['room_title'] = [''+_parent.calcRoomList[_i].getTitle()+''];
//                                        table[i]['name'] = eval("(function(title){return 'Окна '+title+': Откос штукатурка';})");;
//                                        table[i]['price'] = Math.ceil(Number($('#calc-room-length-8').val())*Number($('#calc-room-width-8').val())*100*tablel[key]['otkos_shtuk']*region_coeff);
//                                        table[i]['remontTypeCosmetic'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['remontTypeCapital'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['enableuser'] = true;
//                                        table[i]['enable'] = true;
//                                        table[i]['count_user_room_1'] = false;
//                                        table[i]['count_user_room_2'] = false;
//                                        table[i]['count_user_room_3'] = false;
//                                        table[i]['count_user_room_4'] = false;
//                                        table[i]['count_user_room_5'] = false;
//                                        table[i]['count_user_room_6'] = false;
//                                        table[i]['count_user_room_7'] = false;
//                                        table[i]['podceteg_arr'] = '';
//                                        if(_parent.calcRoomList[_i].getId() == 1) table[i]['count_room_1'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_1'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 2)table[i]['count_room_2'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_2'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 3)table[i]['count_room_3'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_3'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 4)table[i]['count_room_4'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_4'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 5)table[i]['count_room_5'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_5'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 6)table[i]['count_room_6'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_6'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 7)table[i]['count_room_7'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_7'] = function(room){return  0 ;};
//                                        table[i]['priceAll'] = eval(priceAll);
//                                        table[i]['type_id'] = [33,34,35,36,37,38];
//                                        table[i]['windows'] = true;
//                                        
//                                        ++i;
//                                        ++id;
//                                        table[i] = [];
//                                        table[i] = {'id': id};
//                                        table[i]['room_id'] = [''+_parent.calcRoomList[_i].getId()+''];
//                                        table[i]['room_title'] = [''+_parent.calcRoomList[_i].getTitle()+''];
//                                        table[i]['name'] = eval("(function(title){return 'Окна '+title+': Откос пластик';})");;
//                                        table[i]['price'] = Math.ceil(Number($('#calc-room-length-8').val())*Number($('#calc-room-width-8').val())*100*tablel[key]['otkos_plastik']*region_coeff);
//                                        table[i]['remontTypeCosmetic'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['remontTypeCapital'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['enableuser'] = true;
//                                        table[i]['enable'] = true;
//                                        table[i]['count_user_room_1'] = false;
//                                        table[i]['count_user_room_2'] = false;
//                                        table[i]['count_user_room_3'] = false;
//                                        table[i]['count_user_room_4'] = false;
//                                        table[i]['count_user_room_5'] = false;
//                                        table[i]['count_user_room_6'] = false;
//                                        table[i]['count_user_room_7'] = false;
//                                        table[i]['podceteg_arr'] = '';
//                                         if(_parent.calcRoomList[_i].getId() == 1) table[i]['count_room_1'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_1'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 2)table[i]['count_room_2'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_2'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 3)table[i]['count_room_3'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_3'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 4)table[i]['count_room_4'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_4'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 5)table[i]['count_room_5'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_5'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 6)table[i]['count_room_6'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_6'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 7)table[i]['count_room_7'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_7'] = function(room){return  0 ;};
//                                        table[i]['priceAll'] = eval(priceAll);
//                                        table[i]['type_id'] = [33,34,35,36,37,38];
//                                        table[i]['windows'] = true;
//                                        
//                                        i++;
//                                        ++id;
//                                        table[i] = [];
//                                        table[i] = {'id': id};
//                                        table[i]['room_id'] = [''+_parent.calcRoomList[_i].getId()+''];
//                                        table[i]['room_title'] = [''+_parent.calcRoomList[_i].getTitle()+''];
//                                        table[i]['name'] = eval("(function(title){return 'Окна '+title+': Монтаж';})");;
//                                        table[i]['price'] = Math.ceil(Number($('#calc-room-length-8').val())*Number($('#calc-room-width-8').val())*100*tablel[key]['montaj']*region_coeff);
//                                        table[i]['remontTypeCosmetic'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['remontTypeCapital'] = ['calc-price-group-econom','w_d_calc-price-group-econom','calc-price-group-business','w_d_calc-price-group-business','calc-price-group-premium','w_d_calc-price-group-premium','calc-remont-group-cosmetic','calc-remont-group-capital'];
//                                        table[i]['enableuser'] = true;
//                                        table[i]['enable'] = true;
//                                        table[i]['count_user_room_1'] = false;
//                                        table[i]['count_user_room_2'] = false;
//                                        table[i]['count_user_room_3'] = false;
//                                        table[i]['count_user_room_4'] = false;
//                                        table[i]['count_user_room_5'] = false;
//                                        table[i]['count_user_room_6'] = false;
//                                        table[i]['count_user_room_7'] = false;
//                                        table[i]['podceteg_arr'] = '';
//                                         if(_parent.calcRoomList[_i].getId() == 1) table[i]['count_room_1'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_1'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 2)table[i]['count_room_2'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_2'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 3)table[i]['count_room_3'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_3'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 4)table[i]['count_room_4'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_4'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 5)table[i]['count_room_5'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_5'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 6)table[i]['count_room_6'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_6'] = function(room){return  0 ;};
//                                        if(_parent.calcRoomList[_i].getId() == 7)table[i]['count_room_7'] = function(room){return  _parent.calcRoomSize.getCountWindowsInRoom(room) ;};
//                                        else  table[i]['count_room_7'] = function(room){return  0 ;};
//                                        table[i]['priceAll'] = eval(priceAll);
//                                        table[i]['type_id'] = [33,34,35,36,37,38];
//                                        table[i]['windows'] = true;
//                                        i++;
//                                }
//                            }
//
//                        };
//                        $.extend(_data1);
//                        $.get(_url1, _data1, _callback1, "json");
                _this.update();
                };
                $.extend(_data);
                $.get(_url, _data, _callback, "json");
                
                 var _callback = function(data){
                      cat_work = data;
                      for(var cat in data){
                          _this.eneble_cat[cat] = true;
                          _this.eneble_all[cat] = true;
                      }
                 };
                 var _url_c = "/load/workcat";
                $.get(_url_c, _data, _callback, "json");
	};

	
	_this.eneble_c = function () {
            $('input[data-cat="'+$(this).val()+'"]').attr('checked', $(this).prop('checked'));
            _this.eneble_cat[$(this).val()-1] = $(this).prop('checked');
            _this.eneble_all[$(this).val()-1] = false;
            _this.update();
             _this.eneble_all[$(this).val()-1]=true;
        },
	_this.update = function () 
	{
            var sho = $('.mon_show').is(':visible'); 
            
               if(table.length > 0){
		var _list = _this.getList();
		$("#calc-table-installation>table>tbody").empty().append(_list);
                if(sho)   $('.mon_show').show();                   
               }
	};

	// Показать таблицу
	_this.show = function () 
	{
		_this.update();
                $('#show_installation').text('-');
		$("#calc-table-installation").show();
                $("#str-calc-table-work").show();
                $(".mon_show").show();

	};
        _this.see_all = function () {
            if(!$('.mon_show').is(':visible')){
                    $('#installation-show').text('<< Скрыть >>');
                    $('.mon_show').show();
                    $('#show_installation').text('+')
                    $('.count-installation').hide();
            }else{
                    $('#installation-show').text('>> Показать ещё <<');
                    $('.mon_show').hide();
                    $('#show_installation').text('-');
                    $('.count-installation').show();
                    document.location.href = '#remont';
            }
            
        }
	_this.toggle = function()
	{
		if ( $("#calc-table-installation").is(':visible')){
			_this.hide();
			$('#show_installation').text('+');
                        $("#calc-table-installation-end").hide();
                        $('.count-installation').show();
		}else{
			_this.show();
			$('#show_installation').text('-');
                        $('#installation-show').text('<< Скрыть >>');
                        $("#calc-table-installation-end").show();
                        $('.count-installation').hide();
		}
	}

	// Атоматически скрыть таблыцу
	_this.autoHide = function (event) 
	{
		var _target = event.target || this;
		if ( $(_target).parents("#calc-table-installation").length == 0 ){
			_this.hide()
			$(document).off("click", _this.autoHide);
		}
	}

	// Скрить таблыцу
	_this.hide = function () 
	{
            _this.update();
                $('#show_installation').text('+');
		$("#calc-table-installation").hide();
                $('.mon_show').hide();  
                if ( !$("#calc-table-installation").is(':visible') )
                    $("#str-calc-table-work").hide();
	};


	_this.getList = function () 
	{
            var dis = '';
            _this.time_all = 0;
            var tr_numb = 0;
                var _list = "",_i, _total = 0, _id, _enable,  _count, _name, _price, _priceAll,type_id,typ = $('#cacl-work-demon-group .active_econom').attr('id');
                var num = 1;
                var work_cat = 0;
                var chas = 0;
                    if(table.length == undefined)return true;
		for (_i in table){
                    if(table[_i].nv_vt !== null && _parent.calcRemontOld.getRemontType() != Number(table[_i].nv_vt)){
                        table[_i].enable = false;
                            continue;
                    }
                    if (
                        (
                            (
                                $.inArray(_parent.calcRemontPrice.getGroup(), table[_i].remontTypeCosmetic) != -1
                                &&
                                $.inArray(_parent.calcRemontType.getRemontType(), table[_i].remontTypeCosmetic) != -1
                            ) || (
                                $.inArray(_parent.calcRemontPrice.getGroup(), table[_i].remontTypeCapital) != -1
                                &&
                                $.inArray(_parent.calcRemontType.getRemontType(), table[_i].remontTypeCapital) != -1
                            )   
                        )&&(
                            _parent.calcRemontPrice.getGroup()!= ''
                            &&
                            _parent.calcRemontType.getRemontType() != ''
                        )
                                
                        ){
                            var show_in_room = false;
                            var count_room = 0;
                            for(var room in _parent.calcRoomList){
                               
                                if(
                                    _parent.calcRoomList[room].enable()
                                    &&
                                    $.inArray(''+_parent.calcRoomList[room].getType()+'', table[_i].room_id) != -1
                                    ||
                                    table[_i].room_id == ''    
                                ){
                                    // проверка если есть категория
                                    if(table[_i].type_id[0] != ''){
                                        for(var key in table[_i].type_id){
                                            if($('#calc-material-'+_parent.calcRoomList[room].getId()+'-'+table[_i].type_id[key]).prop("checked")){
                                             
                                             // проверка если есть подкатегория
                                                if(table[_i].podceteg_arr == ''){
                                                    show_in_room = true;                                                    
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[key]+'_'+_parent.calcRoomList[room].getId()+' li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                    show_in_room = true;                                                    
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[key]+'_'+_parent.calcRoomList[room].getId()+' li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                    show_in_room = true;                                                    
                                                }else{
                                                    count_room++;
                                                }
                                            }else if($.inArray(table[_i].type_id[key], ['1','33','34','35','36','37','38']) != -1){
                                                show_in_room = true;
                                            }else{
                                                if(table[_i].podceteg_arr == ''){
                                                    show_in_room = false;                                                    
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[key]+'_'+_parent.calcRoomList[room].getId()+' li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                    show_in_room = false;                                                    
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[key]+'_'+_parent.calcRoomList[room].getId()+' li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                    show_in_room = false;                                                    
                                                }else{
                                                    count_room++;
                                                }
                                            }
                                        }
                                    }else{
                                        show_in_room = true;
                                    }
                                }else{
                                    count_room++;
                                }
                            }
                            
                                if(!show_in_room){
                                    table[_i].enable = false;
                                    if(count_room == 13)
                                        continue;
                                }else{
//                                    if(table[_i].enableuser)
                                        table[_i].enable = true;
//                                    else 
//                                        table[_i].enable = false;
                                }
                               
                            
				// Set value
				_id 	= table[_i].id;
				_enable = table[_i].enable;
				type_id = table[_i].type_id;
//                                 console.log(_enable+'     2');
				if(table[_i].windows){
                                    _name 	= table[_i].name(table[_i].room_title);
                                    _price 	= table[_i].price;
                                }  else{
                                    _name 	= table[_i].name;
                                    _price 	= proc[typ](_i);
                                }
                                if(!$('#calc-remont-installing').prop("checked")){
                                        _enable = false;
                                        table[_i].enable = false;
                                }
                                
                                

                                if(tr_numb == 3){
                                    dis = ' class="mon_show"';
                                }else{
                                    tr_numb++;
                                }
				// HTML
                                if(work_cat != table[_i].work_cat){
                                    work_cat = table[_i].work_cat;
                         
                                    _list += "<tr"+dis+" style='background: url(/resources/images/bg_top_table.png) repeat-x 0px 0px;'>";
                                        _list += "<td><input class='calc-installation-cat' id='calc-installation-enable-cat-"+work_cat+"' name=\"\" value=\""+work_cat+"\" type='checkbox' "+(_this.eneble_cat[work_cat-1] ? "checked='cheched'" : "")+"><label for='calc-installation-enable-cat-"+work_cat+"' style='margin-top:0;'></label></td>";
                                        _list += "<td><div class=\"img-"+work_cat+"\"></div></td>";
                                        _list += "<td><span class='work_cat'>"+cat_work[work_cat-1].name+"</span></td>";
                                        _list += "<td></td>";
                                        _list += "<td></td>";
                                        _list += "<td></td>";
                                        _list += "<td></td>";
                                        _list += "<td></td>";
                                        _list += "<td></td>";
                                    _list += "</tr>";
                                }
                               
                                    if(!_this.eneble_all[work_cat-1]){
                                       table[_i]['enable_user'] = _this.eneble_cat[work_cat-1];
                                   }
                                
                                if(table[_i]['enable_user'] === false || table[_i]['enable_user'] === true){
                                    _enable = table[_i]['enable_user'];
                                    table[_i].enable = table[_i]['enable_user'];
                                }
                                if(!_this.eneble_cat[work_cat-1]){
                                    if(table[_i]['enable_user'] === true){
                                       _enable = _this.eneble_cat[work_cat-1];
                                        table[_i].enable = _enable;
                                    }
                                    
                                }
                                
				_list += "<tr"+dis+">";
				_list += "<td><input id='calc-installation-enable-"+_id+"' data-cat='"+work_cat+"' name=\"\" value=\""+_id+"\" type='checkbox' "+(_enable ? "checked='cheched'" : "")+"><label for='calc-installation-enable-"+_id+"' style='margin-top:0;'></label></td>";
				_list += "<td>" + num	+ "</td>";
                                num++;
				_list += "<td>" + _name	+ "</td>";
				_list += "<td id='calc-installation-unit-"+_id+"' align=\"right\" >" + table[_i]['unit']	+ "</td>";
				_list += "<td id='calc-installation-price-"+_id+"' align=\"right\" >" + _price	+ "</td>";
                                _list += "<td align=\"center\">";
                                var countAll = 0;
                                for(var i in _parent.calcRoomList){
                                   
                                    if(_parent.calcRoomList[i].enable() && $.inArray(_parent.calcRoomList[i].getType(), [1,2,3,4,5]) != -1){
                                        if($.inArray(''+_parent.calcRoomList[i].getType()+'', table[_i].room_id) != -1){
                                            _count = 0;
                                              if(table[_i].podceteg_arr == ''){
                                                  // Пробелма в IE7 IE8
                                                    _count =  table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] === false ? table[_i]['count_room_'+_parent.calcRoomList[i].getId()]([_parent.calcRoomList[i].getType()],[_parent.calcRoomList[i].getId()])  : table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()];
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_'+_parent.calcRoomList[i].getId()+' li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                    _count =  table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] === false ? table[_i]['count_room_'+_parent.calcRoomList[i].getId()]([_parent.calcRoomList[i].getType()],[_parent.calcRoomList[i].getId()])  : table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()];
                                                }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_'+_parent.calcRoomList[i].getId()+' li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                    _count =  table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] === false ? table[_i]['count_room_'+_parent.calcRoomList[i].getId()]([_parent.calcRoomList[i].getType()],[_parent.calcRoomList[i].getId()])  : table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()];
                                                }
                                            _list += "<input class='input_filter"+(table[_i]['unit'] == 'шт.'?"_int":"")+"' data-room='"+_parent.calcRoomList[i].getId()+"' id='calc-installation-count-"+_id+"-"+_parent.calcRoomList[i].getId()+"' value='"+ number_format( _count, (table[_i]['unit'] == 'шт.'?0:2), ".", "") +"' data-index='"+_id+"' >";
                                            countAll = Number(countAll)+Number(_count);
                                           
                                        }else{
                                           if(table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] !== false){
                                               _count = table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()];
                                                countAll = Number(countAll)+Number(_count);
                                           }
                                            _list += "<input class='input_filter"+(table[_i]['unit'] == 'шт.'?"_int":"")+"' data-room='"+_parent.calcRoomList[i].getId()+"' id='calc-installation-count-"+_id+"-"+_parent.calcRoomList[i].getId()+"' value='"+(table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()] === false ?'-':table[_i]['count_user_room_'+_parent.calcRoomList[i].getId()])+"' data-index='"+_id+"' >";
                                        }
                                        // Scripts
                                        _list += "<script>";
                                                _list += '$("#calc-installation-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").keyup(calcRemontType.getTableInstallation().onKeyUpPrice);';
                                                _list += '$("#calc-installation-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").change(calcRemontType.getTableInstallation().onChangePrice);';
//                                                _list += '$("#calc-installation-count-'+_id+"-"+_parent.calcRoomList[i].getId()+'").inputmask("decimal", { groupSeparator : "", digits: 2, radixPoint: "." });'; 	// Init input mask
                                        _list += "</script>";
                                    }    
                                }
                                _list += "</td>";
                                
				_list += "<td align=\"center\"><input style=\"text-align: right;\" id='calc-installation-count-"+_id+"' value='"+number_format( countAll, (table[_i]['unit'] == 'шт.'?0:2), ".", "")+"' data-index='"+_id+"' disabled></td>";
                                _list += "<td align=\"center\"><input value='"+ number_format(Number(countAll)*Number(table[_i]['watch']),1, ".", "") +"'  disabled /></td>";
                                if(_enable)chas += Number(countAll)*Number(table[_i]['watch']);
//                                _priceAll = table[_i].priceAll(countAll, _price);
//                                console.log(countAll+' '+_price+'========'+table[_i].name+'  '+table[_i].id);
                                _priceAll = _enable == false ? 0 :  table[_i].priceAll(countAll, _price);
				_list += "<td id='calc-installation-price-all-"+_id+"' align=\"right\" >" +number_format(Math.ceil(_priceAll),0,'.',' ') + "</td>";
				_list += "</tr>";

				// Scripts
				_list += "<script>";
					_list += '$("#calc-installation-enable-'+_id+'").click(calcRemontType.getTableInstallation().onChangeEnable);';
                                _list += "</script>";

				// If service if enable. then increment total price
                                table[_i].enable = _enable;
				if ( _enable)
					_total += _priceAll;
			}else{
                            table[_i].enable = false;
                        }
		};
		if (_list.length == 0){
                    _list += "<tr><td colspan=\"7\"><i>Для этих параметров ремонта нет услуг</i></td></tr>";
                    $('#calc-remont-installation').attr('checked', false);
                    $("#calc-table-installation-end").hide();
                    
                } 
                _this.time_all = chas;
		_list += "<tr class=\"mon_show\">";
		_list += "<td></td><td></td><td></td><td></td><td></td><td></td>";
		_list += "<td align=\"center\"><b>ИТОГО:</b></td><td></td><td align=\"right\">" +number_format(Math.ceil(_total/100)*100,0,'.',' ') + "</td></tr>";

		// Update total price
		_parent.calc.setPriceInstallation(_total);
//                if($('#calc-remont-groups li a').hasClass('remont_active') && $('#cacl-price-group li').hasClass('active_econom')){
////                    $('#help_count').empty();
//                }
                $('.count-installation').text('Всего '+(num-1)+' '+declOfNum(num-1,['работа','работы','работ']));
		return _list;
	}


	/**
	 * Change enable of servise
	 *
	 */
	_this.onChangeEnable = function (event) 
	{
		event.preventDefault();
                if($("input[data-cat='"+$(this).attr('data-cat')+"']:checked").length == 0 ){
                    _this.eneble_cat[$(this).attr('data-cat')-1] = false;                 
                }else{
                    _this.eneble_cat[$(this).attr('data-cat')-1] = true;
                }
		var _id = parseInt(this.value);
		var _enable = this.checked;
		var _i;
		for(_i in table){
			if (table[_i].id == _id){
				table[_i].enable_user = _enable;
				_this.update();
				break;
			}
		}
		return false;
	}

	_this.onKeyUpPrice = function () 
	{
		var _id   = $(this).attr("data-index");
		var _i;
		for(_i in table){
                        for(_i in table){
                                if (table[_i]['id'] == _id){
                                        table[_i]['count_user_room_'+$(this).attr('data-room')] = $(this).val().replace(/\,/, ".");
                                        break;
                                }
                        }
		}
	}


	_this.onChangePrice = function () 
	{
		_this.update();
	}

	// Информация для граббера
	_this.getTableData = function ()
	{
		var _data = [], 
                        _i;
                var typ = $('#cacl-work-demon-group .active_econom').attr('id');
		for(_i in table)
		{
			if (!table[_i].enable)
				continue;

			_id 	= table[_i].id;
			_enable = table[_i].enable;
			if(table[_i].windows){
                            _name 	= table[_i].name(table[_i].room_title);
                        }else{
                            _name 	= table[_i].name;
                        }
                                            _count_1 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_1 =  table[_i]['count_user_room_1'] === false ? table[_i]['count_room_1']([1],[1])  : table[_i]['count_user_room_1'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_1 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_1 =  table[_i]['count_user_room_1'] === false ? table[_i]['count_room_1']([1],[1])  : table[_i]['count_user_room_1'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_1 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_1 =  table[_i]['count_user_room_1'] === false ? table[_i]['count_room_1']([1],[1])  : table[_i]['count_user_room_1'];
                                            }
                      
                                            _count_2 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_2 =  table[_i]['count_user_room_2'] === false ? table[_i]['count_room_2']([1],[2])  : table[_i]['count_user_room_2'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_2 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_2 =  table[_i]['count_user_room_2'] === false ? table[_i]['count_room_2']([1],[2])  : table[_i]['count_user_room_2'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_2 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_2 =  table[_i]['count_user_room_2'] === false ? table[_i]['count_room_2']([1],[2])  : table[_i]['count_user_room_2'];
                                            }
                      
                                            _count_3 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_3 =  table[_i]['count_user_room_3'] === false ? table[_i]['count_room_3']([1],[3])  : table[_i]['count_user_room_3'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_3 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_3 =  table[_i]['count_user_room_3'] === false ? table[_i]['count_room_3']([1],[3])  : table[_i]['count_user_room_3'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_3 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_3 =  table[_i]['count_user_room_3'] === false ? table[_i]['count_room_3']([1],[3])  : table[_i]['count_user_room_3'];
                                            }
                      
                                            _count_4 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_4 =  table[_i]['count_user_room_4'] === false ? table[_i]['count_room_4']([1],[4])  : table[_i]['count_user_room_4'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_4 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_4 =  table[_i]['count_user_room_4'] === false ? table[_i]['count_room_4']([1],[4])  : table[_i]['count_user_room_4'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_4 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_4 =  table[_i]['count_user_room_4'] === false ? table[_i]['count_room_4']([1],[4])  : table[_i]['count_user_room_4'];
                                            }
                      
                                            _count_5 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_5 =  table[_i]['count_user_room_5'] === false ? table[_i]['count_room_5']([1],[5])  : table[_i]['count_user_room_5'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_5 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_5 =  table[_i]['count_user_room_5'] === false ? table[_i]['count_room_5']([1],[5])  : table[_i]['count_user_room_5'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_5 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_5 =  table[_i]['count_user_room_5'] === false ? table[_i]['count_room_5']([1],[5])  : table[_i]['count_user_room_5'];
                                            }
                      
                                            _count_6 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_6 =  table[_i]['count_user_room_6'] === false ? table[_i]['count_room_6']([2],[6])  : table[_i]['count_user_room_6'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_6 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_6 =  table[_i]['count_user_room_6'] === false ? table[_i]['count_room_6']([2],[6])  : table[_i]['count_user_room_6'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_6 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_6 =  table[_i]['count_user_room_6'] === false ? table[_i]['count_room_6']([2],[6])  : table[_i]['count_user_room_6'];
                                            }
                      
                                            _count_7 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_7 =  table[_i]['count_user_room_7'] === false ? table[_i]['count_room_7']([3],[7])  : table[_i]['count_user_room_7'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_7 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_7 =  table[_i]['count_user_room_7'] === false ? table[_i]['count_room_7']([3],[7])  : table[_i]['count_user_room_7'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_7 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_7 =  table[_i]['count_user_room_7'] === false ? table[_i]['count_room_7']([3],[7])  : table[_i]['count_user_room_7'];
                                            }
                                            _count_8 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_8 =  table[_i]['count_user_room_8'] === false ? table[_i]['count_room_8']([4],[8])  : table[_i]['count_user_room_8'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_8 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_8 =  table[_i]['count_user_room_8'] === false ? table[_i]['count_room_8']([4],[8])  : table[_i]['count_user_room_8'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_8 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_8 =  table[_i]['count_user_room_8'] === false ? table[_i]['count_room_8']([4],[8])  : table[_i]['count_user_room_8'];
                                            }
                                            _count_9 = 0;
                                           if(table[_i].podceteg_arr == ''){                                               
                                                _count_9 =  table[_i]['count_user_room_9'] === false ? table[_i]['count_room_9']([5],[9])  : table[_i]['count_user_room_9'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_9 li.active_min a').attr('data-id'), table[_i].podceteg_arr) != -1){
                                                _count_9 =  table[_i]['count_user_room_9'] === false ? table[_i]['count_room_9']([5],[9])  : table[_i]['count_user_room_9'];
                                            }else if(table[_i].podceteg_arr != '' && $.inArray($('.m_'+table[_i].type_id[0]+'_9 li.active_premium a').attr('data-id'),table[_i].podceteg_arr) != -1){
                                                _count_9 =  table[_i]['count_user_room_9'] === false ? table[_i]['count_room_9']([5],[9])  : table[_i]['count_user_room_9'];
                                            }
                             
			_price 	= proc[typ](_i);
			_room_id = table[_i].room_id || 0;
               
			_data.push({
				id	: _id,
				enable 	: _enable,
				name 	: _name,
				room_id : _room_id,
				unit : table[_i]['unit'],
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
	}
    
}
