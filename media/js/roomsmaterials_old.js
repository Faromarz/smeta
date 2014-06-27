/**
 * Обэкт для списка, например обоев, плинтусов ...
 *
 * @version 1.0
 * @todo 	Описать pticeAll для материалов
 */
var o33;
//var numberProfil;
var side;
var side_class;
var style;
var dis;


function priceProfil(_id_scroll, room){
 
    var width = $('#calc-room-width-8').val() || 1.30;
    var length = $('#calc-room-length-8').val() || 1.40;
    var area = Math.round(width*length*100);
    for(i=0; i<profil.length; i++) {
        if (i in profil) {
            var firstProfil = i;
            break;
        }}
    var _room = room || 1;
        
    var number = $("#cacl-price-window > li > a[id='"+_room+"'].active_premium").attr('data-id') || firstProfil;
//    numberProfil = number;
    
    var stvorka1 = profil[number][3];
    var stvorka2 = profil[number][11];
    var stvorka3 = profil[number][12];

    var base_window =  area * profil[number][2];
//    var base_window = area * profil[number][2];
  
    var base_povorot_window = profil[number][4] + area * profil[number][2];
    var base_povorot_otk_window = profil[number][5] + area * profil[number][2];

    var podokonnik = profil[number][6] * width * 10;
    var otkos_sht = profil[number][7] * area;
    var otkos_plast = profil[number][8] * area;
    var montaj = profil[number][9] * area;
    var setka = profil[number][10] * area;
    var framuga = profil[number][13];
    var woodColor = profil[number][14];
    if (width >= 0.4 && width <= 1.0) {
        base_window += stvorka1;
        base_povorot_window += stvorka1;
        base_povorot_otk_window += stvorka1;
    }
    if (width >= 1.001 && width <= 1.7) {
        base_window += stvorka2;
        base_povorot_window += stvorka2;
        base_povorot_otk_window += stvorka2;
    }
    if (width >= 1.701 && width <= 2.7){
        base_window += stvorka3;
        base_povorot_window += stvorka3;
        base_povorot_otk_window += stvorka3;
    }

    if (length >=1.601 && length <= 2.3){
        base_window += framuga;
        base_povorot_window += framuga;
        base_povorot_otk_window += framuga;
    }

    switch (_id_scroll) {
//    switch (numberProfil) {
        case 0:
            o3 =   base_window; break;
        case 1:
            o3 =   base_window + montaj; break;
        case 2:
            o3 =   base_window + montaj + otkos_sht; break;
        case 3:
            o3 =   base_window+ montaj + otkos_plast; break;
        case 4:
            o3 =   base_window+ montaj + otkos_plast + podokonnik; break;
        case 5:
            o3 =   base_window+ montaj + otkos_plast + podokonnik + setka; break;
        case 6:
            o3 =   base_povorot_window; break;
        case 7:
            o3 =   base_povorot_window + podokonnik; break;
        case 8:
            o3 =   base_povorot_window + podokonnik + otkos_sht; break;
        case 9:
            o3 =   base_povorot_window + podokonnik + otkos_plast; break;
        case 10:
            o3 =   base_povorot_window + podokonnik + otkos_plast + montaj; break;
        case 11:
            o3 =   base_povorot_window + podokonnik + otkos_plast + montaj + setka; break;
        case 12:
            o3 =   base_povorot_otk_window; break;
        case 13:
            o3 =   base_povorot_otk_window + podokonnik; break;
        case 14:
            o3 =   base_povorot_otk_window + podokonnik + otkos_sht; break;
        case 15:
            o3 =   base_povorot_otk_window + podokonnik + otkos_plast; break;
        case 16:
            o3 =   base_povorot_otk_window + podokonnik + otkos_plast + montaj; break;
        case 17:
            o3 =   base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka; break;
        case 18:
            if (length >=0.9 && length <= 1.6) {
                o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka + framuga;
            } else {
                o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka;
            }
             break;
        case 19:
            o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka + woodColor;
            if (length >=0.9 && length <= 1.6) {
                o3  += framuga;
            }
            break;
    }
    return o3;
}

function RoomsMaterials ($parent, $material_id, $room, $type)
{
	var _parent		= $parent;
	var _this		= this;
        
        // Стоимость = периметр * цена единицы
        var P_1_2_3	= function( $price ) {
				var _price = parseFloat($price);
				return _price * _parent.calcRoomSize.getPerimeter([1,2,3]);
			};
        // кол-ву помещени. Соответственно возвращаем стоимость единицы
        var сount_rom = function( $price ) {	return parseFloat($price) * _parent.calcRoomSize.getCountRoom([1,2,3,4,5]);};
        var S_room = function( $price ) { 	return _parent.calcRoomSize.getSize() * $price;}
        // площадь укладки=площадь пола + площадь стен - площадь двери - 0.5м2, если ванна, если кабина, то 0,5м2 НЕ вычитаем.
        var S_SD_05 = function( $price ) 
			{
				$price = parseFloat($price);
				var _size;
				_size = _room.getSize() + _room.getPerimeter() * _parent.calcRoomHeight.getHeight();
				_size = _size - 0,5;
				$price = $price * _size;
				return $price > 0 ? $price : 0;
		};
        // площадь укладки=2,6м2, если площадь кухни меньше 12м2, если больше или равна, то 3,2м2
        var S_spec = function( $price ) 
			{
				var _size = _room.getSize() >= 12 ? 3.2 : 2.6;
				return parseFloat($price) * _size; 
			}
        var return_1 = function( $price ) {return parseFloat($price);}
        var door_count = function( $price ) {return parseFloat($price) * _parent.calcRoomSize.getCountDoor([7]);}
        var door_count_ru = function( $price ) {return parseFloat($price) * _parent.calcRoomSize.getCountDoor();}
        var door_count_zam = function( $price ) {return parseFloat($price) * _parent.calcRoomSize.getCountDoor([8]);}
        var oboi =  function( $price, $params, w, l) 
			{
                                var _price = parseFloat($price);
                                var w_t = Number(w.replace(/\,/, "."));
                                var l_t = Number(l.replace(/\,/, "."));
                                var exp_w = w.split('с');
                                if(exp_w[1]){
                                    alert(exp_w[0]);
                                    w_t = Number(exp_w[0])/100;
                                }
                                var exp_l = l.split('с');
                                if(exp_l[1]){
                                    l_t = Number(exp_l[0])/100;
                                }
                                
				var _default = {
					width 	: w_t,	// Ширина по умолчанию 
					leng	: l_t  	// Длина по умолчанию 
				};

				$.extend(_default, $params);

//				// Количество полотен в рулоне  
//				var _rulon_count = Math.ceil( (_room.getPerimeter() - 
//					_parent.calcRoomSize.getWidthRoom([6]) - 
//					_parent.calcRoomSize.getWidthRoom([7])) / _default.width );
				// Количество полотен в рулоне  
                                var S = _room.getPerimeter()
                                        -_parent.calcRoomSize.getWidthRoom([6])
                                        - _parent.calcRoomSize.getWidthRoom([7]);
                              
                                var H = Number(_parent.calcRoomHeight.getHeight());
                                
                               
				var coun = Math.floor(
                                        (S*2/_default.width) / (_default.leng/H)
                                )+1;

				// кол-во полотен в рулоне=длина рулона/высоту потолка (округление в меньшую сторону) 
//				var _polot_count = Math.float(_default.leng/H );
//                                var coun = Math.ceil(_rulon_count / _polot_count);
                                var itog = coun * _price;
                                if(itog)
                                    return itog;
                                else
                                    return alert('Ошибка в обоях: '+
                                        '\r\n ширина рулона из БД:'+w+
                                        "\r\n длина рулона из БД:"+l+
                                        '\r\n ширина рулона:'+_default.width+
                                        "\r\n длина рулона:"+_default.leng+
                                        "\r\n Высота:"+H+
                                        "\r\n цена:"+_price+
                                        "\r\n Общий периметр:"+_room.getPerimeter()+
                                        "\r\n Ширина окон:"+_parent.calcRoomSize.getWidthRoom([6])+
                                        "\r\n Ширина дверей:"+_parent.calcRoomSize.getWidthRoom([7])+
                                        "\r\n количество:"+coun+
                                        ""
                                    );

			};
        var kley_plit= function( $price ) { 
				var _room = [];

				for(var i in Ballon.enabled)
				{
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][4] !== undefined && Ballon.enabled[i][4] == true)
						_room.push(i);
				}

				return parseFloat($price) * (_parent.calcRoomSize.getRoomSize(_room) * 3.5/25); 
			};
        var zatir = function( $price ) {
				var _room = [];
				for(var i in Ballon.enabled){
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][4] !== undefined && Ballon.enabled[i][4] == true)
						_room.push(i);
				}
				return parseFloat($price) * (_parent.calcRoomSize.getPerimeter(_room) * _parent.CalcRoomHeight.getHeight() * 0.5/2);
			};
        var kley_oboi = function( $price ) { 
				var _room = [];
				for(var i in Ballon.enabled){
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][13] !== undefined && Ballon.enabled[i][13] == true)
						_room.push(i);
				}				
				return parseFloat($price) * Math.ceil( _parent.calcRoomSize.getPerimeter(_room) * _parent.CalcRoomHeight.getHeight() /13 ); 
			};
       var window = function( $price, $id, $room )
            {
                var _price = parseFloat($price);
//                var count_windows = _parent.calcRoomSize.getCountWindow();
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom($room);
                var o33 = priceProfil(0, $room);
                    var pric  = count_windows * o33;
                    if(pric)
                        return pric;
                    else
                        alert("Не могу посчитать цену окна 38 количество окон:"+count_windows+" цена:"+o33);
            }
	var _material_id = $material_id || 1;
        var ili = 1;
        if($material_id == 13) ili = 2;
        var _type = $type || ili;

	// Комната и ее ID
	var _room, _room_id;       
       
	var _materials	= {
            // проверено
		1 : 
		{
			title : "Плинтус", // **
			priceAll : function( $price ) 
			{
				// Стоимость = периметр * цена единицы
				var _price = parseFloat($price);
				return parseFloat(_price * _parent.calcRoomSize.getPerimeter([1,2,3]));
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		2  :
		{
			title : "Порог", // **
			priceAll : function( $price ) 
			{
				// кол-ву помещени. Соответственно возвращаем стоимость единицы
				return parseFloat($price) * _parent.calcRoomSize.getCountRoom([1,2,3,4,5]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		3  :
		{
			title : "Плитка", // для ванной и туалета
			priceAll : function( $price ) 
			{
				// площадь укладки=площадь пола + площадь стен - площадь двери - 0.5м2, если ванна, если кабина, то 0,5м2 НЕ вычитаем.
				$price = parseFloat($price);
		
				var _size;
				
				_size = _room.getSize() + _room.getPerimeter() * _parent.calcRoomHeight.getHeight();

				_size = _size - 0,5;

				$price = $price * _size;

				return $price > 0 ? $price : 0;
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		4  :
		{
			title : "Плитка", // только для кухни
			priceAll : function( $price ) 
			{
				// площадь укладки=2,6м2, если площадь кухни меньше 12м2, если больше или равна, то 3,2м2
				var _size = _room.getSize() >= 12 ? 3.2 : 2.6;

				return parseFloat($price) * _size; 
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		5  :
		{
			title : "Дверь входная", // **
			priceAll : function( $price )
			{
				return parseFloat($price);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		6  :
		{
			title : "Дверь межкомнатная", // **
			priceAll : function( $price ) {
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor([7]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		7  :
		{
			title : "Дверные ручки", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor();
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		8  :
		{
			title : "Замки", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor([8]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		9  :
		{
			title : "Защёлки", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor([7]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		10  :
		{
			title : "Накладки дверные", // *
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor([8]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		11 :
		{
			title : "Петли", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor();
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		12 :
		{
			title : "Цилиндры", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountDoor([8]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium", "calc-remont-group-capital"],
                        remontTypeDef2  : []
		},
// проверена
		13 :
		{
			title : "Обои", // **
			priceAll : function($room_id, $material_id, $id) 
			{
//                            var w = Number(Ballon.materials[$room_id][$material_id][$id].wid.replace(/\,/, "."));
                            var w = Number(Ballon.materials[$room_id][$material_id][$id].wid.replace(/\,/, "."))*3;
                            var l = Number(Ballon.materials[$room_id][$material_id][$id].lon.replace(/\,/, "."));
                            var _price = parseFloat(Ballon.materials[$room_id][$material_id][$id].price);
       
//                            var P = Number(_room.getPerimeter())-Number(_parent.calcRoomSize.getWidthRoom([6]))-Number(_parent.calcRoomSize.getWidthRoom([7]));
                            var P = Number(_room.getPerimeter())-Number(_parent.calcRoomSize.getWidthRoom([7]))-Number($.inArray(_room.getType(), [1,2]) != -1 ?_room.balcon()?1.6:0:0);
                            var H = Number(_parent.calcRoomHeight.getHeight());
                                  
                                  console.log(Number($.inArray(_room.getType(), [1,2,3]) != -1 ?_room.balcon()?1.6:0:0));
                                
                                
//                            var coun = Math.floor((P*2/w) / (l/H))+1;
                            var coun = Math.ceil(P/w);
                            var itog = coun * _price;
                            if(itog)
                                return itog;
                            else
                                return alert('Ошибка в обоях, комната: '+$room_id+
                                    '\r\n Периметр:'+_room.getPerimeter()+
                                    '\r\n Периметр окна:'+_parent.calcRoomSize.getWidthRoom([7])+
                                    '\r\n ширина рулона из БД:'+w+
                                    "\r\n длина рулона из БД:"+l+
                                    "\r\n цена:"+_price+
                                    "\r\n id:"+Ballon.materials[$room_id][$material_id][$id].id+
                                    ""
                                );

			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},
		14 :
		{
			title : "Обои", // **
			priceAll : function ( $price, $params )
			{	
				// считать кол-во рулонов:
                                // 1.кол-во полотен в комнате=(периметр комнаты-ширина двери-ширина окна-3м,
                                //  если площадь менее 12м и -4м,
                                //   если площадь боле или равен 12м.)/ширину обоев (округление в большую сторону), 
                                // 2. кол-во полотен в рулоне=длина рулона/высоту потолка (округление в меньшую сторону)
                                // 3. 1/2= кол-во полотен в комнате.
				var _price = parseFloat($price);
				var _default = {
					width 	: 1,	// Ширина по умолчанию 
					leng	: 5  	// Длина по умолчанию 
				};

				$.extend(_default, $params);

				// Количество полотен в рулоне  
				var _rulon_count = Math.ceil( (_room.getPerimeter() - 
					_parent.calcRoomSize.getWidthRoom([6]) - 
					_parent.calcRoomSize.getWidthRoom([7]) - 
					(_room.getSize() >= 12 ? 4 : 3)) / _default.width );
                              

				// кол-во полотен в рулоне=длина рулона/высоту потолка (округление в меньшую сторону) 
				var _polot_count = Math.floor( _default.leng / _parent.calcRoomHeight.getHeight() );

				return _rulon_count / _polot_count * _price;
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		15 :
		{
			title : "Краска", // Для коридора
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		16 :
		{
			title : "Краска", //  Для ванной
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		17 :
		{
			title : "Ванна/Кабина", // **
				// Длинна ванной не д.б. больше максимальной стороны ванной комнаты!
			priceAll : function( $price ) 	{return parseFloat($price);	
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		18 :
		{
			title : "Унитаз", // **
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		19 :
		{
			title : "Умывальник", // **
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		20 :
		{
			title : "Смеситель", // **
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		21 :
		{
			title : "Полотенцесушитель", // **
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		22 :
		{
			title : "Кондиционер", // **
			priceAll : function($room,$material_id,$id) {
                            var _price = parseFloat(Ballon.materials[$room][$material_id][$id].price);
                            return parseFloat(_price);
                        },
                        remontTypeDef  : ["calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : ["calc-price-group-premium","calc-remont-group-cosmetic",]
		},

		23 :
		{
			title : "Отопление", // **
			priceAll : function($room,$material_id,$id) {
                            
                            var _price = parseFloat(Ballon.materials[$room][$material_id][$id].price);
                            return parseFloat(_price); 
                        },
                        remontTypeDef  : ["calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		24 :
		{
			title : "Клей для плитки", // **
			priceAll : function( $price ) { 
				var _room = [];
				for(var i in Ballon.enabled){
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][4] !== undefined && Ballon.enabled[i][4] == true)
						_room.push(i);
				}
				return parseFloat($price) * (_parent.calcRoomSize.getRoomSize(_room) * 3.5/25); 
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		25 :
		{
			title : "Затирка", // **
			priceAll : function( $price ) {
				var _room = [];
				for(var i in Ballon.enabled){
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][4] !== undefined && Ballon.enabled[i][4] == true)
						_room.push(i);
				}
				return parseFloat($price) * (_parent.calcRoomSize.getPerimeter(_room) * _parent.CalcRoomHeight.getHeight() * 0.5/2);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		26 :
		{
			title : "Клей для обоев", // **
			priceAll : function( $price ) { 
				var _room = [];
				for(var i in Ballon.enabled){
					if (Ballon.enabled[i] !== undefined && Ballon.enabled[i][13] !== undefined && Ballon.enabled[i][13] == true)
						_room.push(i);
				}				
				return parseFloat($price) * Math.ceil( _parent.calcRoomSize.getPerimeter(_room) * _parent.CalcRoomHeight.getHeight() /13 ); 
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		27 :
		{
			title : "Подложка", // **
			priceAll : function( $price ) { 
				return 0;
				// return parseFloat($price) ; 
			},
                        remontTypeDef  : ["calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		28 :
		{
			title : "Клей для пола", // *
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		29 :
		{
			title : "Лак для пола", // **
			priceAll : function( $price ) { return parseFloat($price); 
                        },
                        remontTypeDef  : ["calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

		30 :
		{
			title : "Клея для линолеума", // **
			priceAll : function( $price ) { 
				return parseFloat($price) * _parent.calcRoomSize.getCountRoom([1,2,3,4,5]);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},
// проверена
		31 :
		{
			title : "Потолок", // **
			priceAll : function($room,$material_id,$id) {
                            
                            var _price = parseFloat(Ballon.materials[$room][$material_id][$id].price);
                            return parseFloat(_room.getSize() * _price);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-cosmetic","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},
// проверенно
		32 :
		{
			title : "Пол", // **
			priceAll : function($room,$material_id,$id) 
			{ 
                            var _price = parseFloat(Ballon.materials[$room][$material_id][$id].price);
                            return parseFloat(_room.getSize() * _price);
			},
                        remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
		},

        33 :
        {
            title : "Окна", // ** Окна одностворчатые
            priceAll : function( $price , $id, $room)
            {
                if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                 var o33 = priceProfil($id, getRoomByType($room));
                 console.log(o33);
               var pric  = count_windows * o33;
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 33 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
            },
                remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },

        34 :
        {
            title : "Окна", // ** Окна одностворчатые с фрамугой
            priceAll : function( $price , $id, $room)
            {
                 if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                var o33 = priceProfil($id, getRoomByType($room));
                console.log(o33);
                var pric  = count_windows * o33;
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 34 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
                       
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },

        35 :
        {
            title : "Окна", // **Окна двустворчатые
            priceAll : function( $price, $id, $room )
            {
                if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                if(getRoomByType($room) == -1)count_windows = Number(_parent.calcRoomSize.getCountWindow())-Number(_parent.calcRoomSize.getCountRoom([1,2]));
                var o33 = priceProfil($id, $room);
//                console.log(o33);
                var pric  = count_windows * o33;
               
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 35 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },

        36 :
        {
            title : "Окна", // ** окна  двустворчатые с фрамугой
            priceAll : function( $price, $id, $room )
            {
                 if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                var o33 = priceProfil($id, getRoomByType($room));
                console.log(o33);
                var pric  = count_windows * o33;
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 36 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },

        37 :
        {
            title : "Окна", // ** трехстворчатые
            priceAll : function( $price, $id, $room )
            {
               if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                var o33 = priceProfil($id, getRoomByType($room));
                var pric  = count_windows * o33;
                console.log(o33);
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 37 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        }
        ,

        38 :
        {
            title : "Окна", // ** трехстворчатые с фрамугой
            priceAll : function( $price, $id, $room )
            {
                if($price >=0 && $price <= 5){
                    $id = 0;
                }else if($price >=6 && $price <= 11){
                    $id = 6;
                }else if($price >=12){
                    $id = 12;
                }
                var count_windows = _parent.calcRoomSize.getCountWindowsInRoom(getRoomByType($room));
                var o33 = priceProfil($id, getRoomByType($room));
                    var pric  = count_windows * o33;
                    if(pric)
                        return pric;
                    else{
                        console.log("Ошибка окна 38 количество окон:"+count_windows+" цена:"+o33+' room:'+$room);
                    }
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },
        40 :
        {
            title : "Для раковины", // для ванной
            priceAll : function( $price ) { return parseFloat($price); 
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        },
// проверено
        41 :
        {
            title : " Фартук", // для кухни
            priceAll : function($room,$material_id,$id) {
                
                var _size = _room.getSize() >= 12 ? 3.2 : 2.6;
                var price = Number(Ballon.materials[$room][$material_id][$id].price);
                return parseFloat(price*_size);
                
            },
            remontTypeDef  : ["calc-price-group-econom", "calc-price-group-business", "calc-price-group-premium","calc-remont-group-capital"],
                        remontTypeDef2  : []
        }

	};

	_this.getMaterial = function () 
	{ 
		return _materials[_material_id];
           
	};

	_this.init = function ()
	{
                      
		if (typeof $room == "object"){
			_room = $room;
		}else{
			_room = getRoomById(parseInt($room));
		}
		_room_id = _room.getId();
                
	};

	
	_this.render = function () {
            
            if(side == 'left_prew'){
                side = 'right_prew';
                side_class = 'oboi'
                style = 'right:-253px;';
            } else{
                side = 'left_prew';
                side_class = 'plintus'
                style = 'left: -241px;';
            }
            if($('#show_wind_all').attr('data-vis') == 1){
                dis = 'block';
            }else{
                dis = 'none';
            }
                
            var _id_index   = _room_id+"-"+_material_id;
            var _is_enabled = (Ballon.enabled[_room_id] && Ballon.enabled[_room_id][_material_id] == true) ? true : false;
            var _html = '';
            var _value      = ((Ballon.selected_materials[_room_id] != undefined) && (Ballon.selected_materials[_room_id][_material_id] != undefined)) ? Ballon.selected_materials[_room_id][_material_id] : 0;
            var rooms       = profil.length;
            var class_r     = $('#cacl-price-group .active_econom').attr("id");
            var profil_wind = 2;
            // окна на кухне
            if(_material_id >= 33 && _material_id<=38){
                if(((_room_id == 2 && Number($('#calc-room-count-6').text()) < 2) ||(_room_id == 1 && Number($('#calc-room-count-6').text()) < 1)) && Ballon.enabled[_room_id] && Ballon.enabled[_room_id][_material_id]){
                        Ballon.enabled[_room_id][_material_id] = false;
                    }
            }
            
            if (_room_id <= rooms) {
                var _room_params= "{width: " + _room.getWidth() + ", length: " + _room.getLength() + "}";
            }
            
            _html  = "<div";
                var add_class = '';
                if(_parent.calcRemontMaterials.get_count_materials_show() > 2 ){
                    var add_class = ' hide_mater';
                }
            if(_material_id >= 33 && _material_id<=38){
                _html += " class='block_windows item_material"+add_class+"'>";
                _is_enabled = true;
            } else {
                _html += " class=\"item_material"+add_class+"\">";
            }
             if ( 
                    (
                        $.inArray(_parent.calcRemontPrice.getGroup(), _materials[_material_id].remontTypeDef) != -1
                        &&
                        $.inArray(_parent.calcRemontType.getRemontType(), _materials[_material_id].remontTypeDef) != -1
                    )
                    ||
                    (
                        _materials[_material_id].remontTypeDef2 != ''
                        &&
                        $.inArray(_parent.calcRemontPrice.getGroup(), _materials[_material_id].remontTypeDef2) != -1
                        &&
                        $.inArray(_parent.calcRemontType.getRemontType(), _materials[_material_id].remontTypeDef2) != -1
                    )
                ){
                    _is_enabled = true;
                }else{
                    _is_enabled = false;
                }
                if(!_parent.calcRemontMaterials.get_user_eneble()){
                    _is_enabled = false;
                }
            
        _html += "<span title='"+_this.getMaterial().title+"'>" + _this.getMaterial().title + "</span>";
        _html += '<input type="checkbox" id="calc-material-'+_id_index+'"  '+(_is_enabled ? 'checked="checked"' : '') +'><label for="calc-material-'+_id_index+'"></label>';
        if(_this.getMaterial().title == 'Обои' && _material_id == 13) {
            if(class_r == 'calc-price-group-econom'){
                type = 2;
            }else if(class_r == 'calc-price-group-business'){
                _type = 1;
            }else if(class_r == 'calc-price-group-premium'){
                _type = 5;
            }
                        _html += "<ul id='cacl-price-wallpaper' class='cacl_select_type m_13_"+_room_id+"' data-id='"+_room_id+"'>";
                                _html += "<li data-id='13' "+(class_r == 'calc-price-group-econom' ? 'class="active_premium"' : '') +"><a data-id='2' id="+_room_id+" href='javascript: void(0)' ><span>Виниловые</span></a></li>";
                                _html += "<li data-id='13' "+(class_r == 'calc-price-group-business' ? 'class="active_premium"' : '') +"><a data-id='1' id="+_room_id+" href='javascript: void(0)' ><span>Флизелиновые</span></a></li>";
                                _html += "<li data-id='13'><a data-id='3' id="+_room_id+" href='javascript: void(0)'><span>Текстильные</span></a></li>";
                                if($(".active_econom").attr("id") === "calc-price-group-business")_html += "<li data-id='13'><a data-id='4' id="+_room_id+" href='javascript: void(0)'><span>Флоковые</span></a></li>";
                                if($(".active_econom").attr("id") === "calc-price-group-premium") _html += "<li data-id='13' "+(class_r == 'calc-price-group-premium' ? 'class="active_premium"' : '') +"><a data-id='5' id="+_room_id+" href='javascript: void(0)' ><span>Натуральные</span></a></li>";
                                if($(".active_econom").attr("id") === "calc-price-group-econom") _html += "<li data-id='13'><a data-id='6' id="+_room_id+" href='javascript: void(0)'><span>Бумажные</span></a></li>";
                                if($.inArray(_room.getType(), [2,3,4,5])!= -1){
                                    _html += "<li data-id='13'><a data-id='7' id="+_room_id+" href='javascript: void(0)'><span>Плитка</span></a></li>";
                                }
                        _html += "</ul>";
        }else if(_this.getMaterial().title == 'Пол' && _material_id == 32) {
            if($.inArray(_room.getType(), [1,2,3])!= -1){
                if(class_r == 'calc-price-group-econom'){
                     if(_room.getType() == 1){
                        _type = 2;
                     }else{
                        _type = 1;
                     }
                }else if(class_r == 'calc-price-group-business'){
                        _type = 2;
                }else if(class_r == 'calc-price-group-premium'){
                    if(_room.getType() == 1){
                        _type = 5;
                     }else{
                        _type = 3;
                     }
                }
            }else if($.inArray(_room.getType(), [4,5])!= -1){
                _type = 3;
            }
                        _html += "<ul id='cacl-price-floor' class='cacl_select_type m_32_"+_room_id+"'>";
                                _html += "<li id='1' data-id='32'"+(_type == 1 ? 'class="active_min"' : '') +"><a data-id='1' id="+_room_id+" href='javascript: void(0)'><span>Линолеум</span></a></li>";
                                _html += "<li id='2' data-id='32' "+(_type == 2 ? 'class="active_min"' : '') +"><a data-id='2' id="+_room_id+" href='javascript: void(0)' ><span>Ламинат</span></a></li>";
//                              if((_room_id == 4 && $('#cacl-room-title-4').text() != 'Bанна')||_room_id != 5)  _html += "<li id='4' data-id='32' ><a data-id='4' id="+_room_id+" href='javascript: void(0)'><span>Пробка</span></a></li>";
                              if((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна')||_room.getType() != 5)  _html += "<li id='5' data-id='32' "+(_type == 5 ? 'class="active_min"' : '') +"><a data-id='5' id="+_room_id+" href='javascript: void(0)'><span>Паркет</span></a></li>";
                               if((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна')||_room.getType() != 5) _html += "<li id='6' data-id='32' "+(_type == 6 ? 'class="active_min"' : '') +"><a data-id='6' id="+_room_id+" href='javascript: void(0)'><span>Массив</span></a></li>";
                               if((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна')||_room.getType() != 5) _html += "<li id='7' data-id='32' "+(_type == 7 ? 'class="active_min"' : '') +"><a data-id='7' id="+_room_id+" href='javascript: void(0)' ><span>Модули</span></a></li>";
                          
                            if(
                                    (_room.getType() != 1)
                                    ||
                                    (_room.getType() == 3 && $('.remont_active').attr("id") === 'calc-remont-group-capital')
                                    ||
                                    (_room.getType() == 4)
                                    ||
                                    (_room.getType() == 5 && $('.remont_active').attr("id") === 'calc-remont-group-capital')
//                                    
                            ){ 
                                    _html += "<li id='3' data-id='32' "+(_type == 3 ? 'class="active_min"' : '') +"><a data-id='3' id="+_room_id+" href='javascript: void(0)'><span>Плитка</span></a></li>";
                                }
                        _html += "</ul>";
                        
        }else  if(_material_id >= 33 && _material_id<=38) {
           
            if (profil.length > 0) {_html += "<ul id='cacl-price-window' class='cacl_select_type'>";}
            for (var i = 0; i < profil.length; i++) {
                if (i in profil) {
                    if(class_r == 'calc-price-group-econom' && profil[i][1] == 2)profil_wind = 2;
                    else if(class_r == 'calc-price-group-business' && profil[i][1] == 3)profil_wind = 3;
                    else if(class_r == 'calc-price-group-premium' && profil[i][1] == 4)profil_wind = 4;
                    var clas = '';
                    // при обновлении выбираем нужный блок
                    if(class_r == 'calc-price-group-econom' && profil[i][1] == 2)clas ='class="active_premium"';
                    else if(class_r == 'calc-price-group-business' && profil[i][1] == 3)clas ='class="active_premium"';
                    else if(class_r == 'calc-price-group-premium' && profil[i][1] == 4)clas ='class="active_premium"';
                    _html += "<li data-id='"+_material_id+"'><a data-id='"+profil[i][1]+"' id='"+_room_id+"'  href='javascript: void(0)' "+
                            clas +"><span>"+profil[i][0]+"</span></a></li>";
                }
            }
        }
            if (profil.length > 0) {_html += "</ul>";}
                    ///       slider   
			_html += '<div class="demo">';
				_html += '<div id="slider-'+_id_index+'" class="slider">';
					_html += '<img alt="" src="/resources/images/slider_left_bg.png">';
					_html += '<img alt="" src="/resources/images/slider_right_bg.png">';
				_html += '</div></div>';
			_html += '<span class="pric_r" id="pr_'+_room_id+'_'+_material_id+'">';
                               _html += '<a href="" target="_blank"></a></span>'+
                                       '<div id="'+side+'" class="div_'+side_class+'_perview window-show-'+_room_id+'-'+_material_id+' window-show-all" style="'+style+'display: '+dis+'; top: -12px; opacity: 1; overflow: hidden; height: 105px; margin: 0px; padding: 0px; width: 244px;">'+
						'<table class="left_prew">'+
							'<tbody><tr>'+
								'<td>'+
									'<img alt="" class="image" height="80px" width="80px" src="/resources/images/preview_img.png" onerror="this.src =\'/resources/images/pattern.png\'">'+
								'</td>'+
								'<td><div style="position:relative;">'+
									'<span class="name" style="font-size: 11px;width: 123px;height: 27px;"><a href="/catalog/product/show/34528" target="_blank" title="" class=""></a></span>'+
									'<p class="description"></p>'+
									'<span  style="font-size: 11px;width: 123px;position:static" class="price" title=""></span>'+
								'</div></td>'+
							'</tr>'+
						'</tbody></table>'+
					'</div>'+
                                       '';//side
//                            }
                        
		_html += '</div>';
		_html += '<script>';
			_html += "$('#slider-"+_id_index+"').slider({";
				_html += "min: 0,";
				_html += "value: "+_value+",";
				_html += "max: 20,";
				_html += "step: 1,";
				_html += "create: function () { Ballon.load("+_room_id+", "+_material_id+", 21, "+_type+', '+_room_params+","+profil_wind+");},";
				_html += "slide: function (e, ul) { " +
                                        "var _item = $(this).parents('.item_material');" +
                                        "o33 = priceProfil(0, "+_room_id+");" +
                                        "if("+_material_id+">=33 && "+ _material_id +"<=38){" +
                                            " Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, o33);" +
                                        "}else {Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, 0);} },";
				_html += "stop : function (e, ul) { var _item = $(this).parents('.item_material');  Ballon.stop(_item, "+_room_id+", "+_material_id+", ul.value); },";
                                _html += "});";
                                
                                _html += '$("#calc-material-'+_id_index+'").on("change", function() { Ballon.onEnabled('+_room_id+', '+_material_id+', this.checked, true) })';
                                _html += '</script>';
                                _parent.calcRemontMaterials.add_count_materials_show();
        _item = $(this).parents('.item_material');

		return _html;
      
	};
        
	_this.init();
       
               
}