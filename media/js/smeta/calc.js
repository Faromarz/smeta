/**
 * Класс калькулятора
 *
 * @author 	senj
 * @version 1.0
 * 
 * @param {object} $parent description
 */
function Calc($parent)
{
    var _this = this;
    var _parent = $parent;
    var _price = 0;
    var _works = {
        0: {
            watch: 0,
            price: 0
        },
        1: {
            watch: 0,
            price: 0
        }
    };
    _this.partner = {id: 0};
//                var _def                        = true;
//                var _PAYMENT_NO			= "";	// НОМЕР ЗАКАЗА
//                var _PAYMENT_AMOUNT		= ""; 	// СУММА ЗАКАЗА
//                var _PAYMENT_DESC		= ""; 	// КОММЕНТАРИЙ К ЗАКАЗУ
//                var _CLIENT_MAIL		= "";	// E-MAIL ПОКУПАТЕЛЯ
    var _form = document.getElementById("save_smeta");
//                var _priceLabels 		= $(".priceLabel");
//                var _priceInstallation          = 0;
//                var _priceDismantling           = 0;
//                var work_piple	= 0;
//                var work_time	= 0;
//                var instr	= 'Смету и цены для какой квартиры хотите получить? Укажите сколько у вас комнат, что бы получить предварительную оценку ремонта вашей квартиры';
//                var injener = 0;


//	// Цена на монтажные работы
//	_this.setPriceInstallation = function ($price){
//		_priceInstallation = Number($price);
//		_this.update();
//	};
//
//	// Цена на демонтажные работы
//	_this.setPriceDismantling = function ($price){
//		_priceDismantling =  Number($price);
//		_this.update();
//	};

    // Цена общая
    _this.getPrice = function() {
        console.log('считаем цену сметы (обманка)');
//                $('.price_all_work').text(number_format(Math.ceil(Number(_priceInstallation + _priceDismantling)/100)*100,0,'.',' ')+ ' руб');
//                $('.price_all_mater').text( number_format(Math.ceil(Number( Ballon.getPrice())/100)*100,0,'.',' ') + ' руб');
//                var count = (_parent.calcRemontType.getTableDismantling().time_all+_parent.calcRemontType.getTableInstallation().time_all);
//      
//                var count_day = count/Number(_this.work_piple)/(Number(_this.work_time));
//                if(count_day != 0)
//                    $('.srock').text( Math.ceil(count_day) + ' '+declOfNum(count_day,['день','дня','дней']));
//                else
//                     $('.srock').empty();
//		return _priceInstallation + _priceDismantling + Ballon.getPrice();

    };

    // Обновление цены
    _this.update = function()
    {
        console.log('обновляем цену сметы');
        _price = 0;
        _works = {
            0: {
                watch: 0,
                price: 0
            },
            1: {
                watch: 0,
                price: 0
            }
        };
        var _room, _cat, _dem, _mon;
        for (_room in _parent.rooms.room) {
            // перебираем категории
            for (_cat in _parent.rooms.room[_room].categories) {
                if (_parent.rooms.room[_room].categories[_cat].enable) {
                    if (_parent.rooms.room[_room].categories[_cat].getMaterial() !== undefined) {
                        _price += Number(_parent.rooms.room[_room].categories[_cat].getPriceAll());
                    }
                }
            }
            // перебираем работы демонтаж
            for (_dem in _parent.rooms.room[_room].work_dem) {
                if (_parent.rooms.room[_room].work_dem[_dem].enable) {
                    _works[0].watch += Number(_parent.rooms.room[_room].work_dem[_dem].work.watch);
                    _works[0].price += Number(_parent.rooms.room[_room].work_dem[_dem].price_all);
                }
            }
            // перебираем работы монтажные
            for (_mon in _parent.rooms.room[_room].work_mon) {
                if (_parent.rooms.room[_room].work_mon[_mon].enable) {
                    _works[1].watch += Number(_parent.rooms.room[_room].work_mon[_mon].work.watch);
                    _works[1].price += Number(_parent.rooms.room[_room].work_mon[_mon].price_all);
                }
            }
        }
        _parent.rooms.price_materials = _price;
        _parent.rooms.price_work_dem = _works[0].price;
        _parent.rooms.price_work_mon = _works[1].price;
        _parent.rooms.time_work_dem = _works[0].watch;
        _parent.rooms.time_work_mon = _works[1].watch;
        $('.dem-watch').text(_works[0].watch.toFixed(2).replace(/\./, ",") + ' часов');
        $('.dem-price').text(number_format(_works[0].price, '2', ',', ' ') + ' р.');
        $('.mon-watch').text(_works[1].watch.toFixed(2).replace(/\./, ",") + ' часов');
        $('.mon-price').text(number_format(_works[1].price, '2', ',', ' ')+ ' р.');
        $('#your_price_without_discount h2:eq(0)').text(number_format(_price, '2', ',', ' ') + '  р');
        $('#materials_summ h1').text(number_format(_price, '2', ',', ' ') + '  р');
        $('#your_price_without_discount h2:eq(1)').text(number_format(Number(_works[0].price + _works[1].price), '2', ',', ' ')  + '  р');
//                        var _price = _this.getPrice();
//		_priceLabels.text( formatPrice( Number(_price)) );
//                        if(Number(_price) > 0){
//                    $('.calc_load').show();
//                    if($('#help_count').attr('data-id') == 'one'){
//                        $('#help_count').html('Наши инженеры<br /> считают смету');
//                      
//                    }else{
//                        $('#help_count').html('Наши инженеры<br /> пересчитывают смету');
//                    }
//                    if($('#help_count').attr('data-id') == 'and'){
//                       setTimeout(function() {$('#help_count').empty();$('#help_count').attr('data-id','and')},5000);
//                        $('#help_count').attr('data-id','two');
//                        
//                    }
//                        }else if($('#calc-remont-groups li a').hasClass('remont_active') && $('#cacl-price-group li').hasClass('active_econom')){
//                            $('#help_count').attr('data-id','and');
//                        }
//                $('#all-price-center').text(formatPrice( Number(_price)));

    };

    // Кнопка "Расчитать стоимость"
    _this.submit = function(e)
    {
//                
//                if(_priceInstallation + _priceDismantling + Ballon.getPrice() == 0 || !_def)
//                    {//data.load.name2
//                
//                        var c = $('<div id="modal" class="box-modal" style="max-width: 500px;" />');
//                          c.html($('.b-text').html());
//                          c.prepend('<div class="close arcticmodal-close" style="cursor:pointer;text-align: right;">X</div>'+'<div>'+instr+'</div><div class="form form_open"><div id="coun_rom" class="row counts">'+$('#coun_rom').html()+'</div></div>' );
//                          $.arcticmodal({
//                              closeOnOverlayClick:false,
//                              content: c
//                          });
//                        $('.calc_load').hide();
//                        $('#help_count').hide();
// 
//                    return false;
//                    }
//                    
//                    $('.calc_load').show();
//                    $('#help_count').show(); 
//
//		_this.update();
//
        var _data = "{room:{id:1,type:1}}";
        $('#smeta_value').val(_data);
//		var _url	= "/catalog/payment/create_calc";
//		var _callbk	= function (data, textStatus, jqXHR){
//			if (!data.status)
//				return alert(data.errors);
        _this.clickSubmit(_data);
//		};
//
//		$.post(_url, _data, _callbk, "json");
//                $.ajax({
//                    type: "POST",
//                    url: "/catalog/load/load",
//                    dataType: "json",
//                    success: function(data) {
//                        if(data.name){}
//                    },
//                    complete: function(){
//                        $('.calc_load').hide();
//                        $('#help_count').hide();
//                    }
//                })
//               
//                return false;
////		setTimeout(function(){return true}, 5000);
    };


    // Запрись в базу
    _this.changeSubmit = function()
    {
//		_PAYMENT_NO	= $data['calc_number'] || 1;
//		_PAYMENT_AMOUNT = _this.getPrice();
////		_PAYMENT_DESC	= "Мы рады предоставить вам максимально возможную удаленную смену за " + _PAYMENT_AMOUNT + " руб.";
////		_CLIENT_MAIL	= "";
//
//		// Тест. Просмотр PDF
//		_form.action = "/smeta/" + _PAYMENT_NO;
//
//		if ( _form && _PAYMENT_AMOUNT > 0 )
//		{
////			_form.LMI_PAYMENT_NO.value 	= _PAYMENT_NO;
////			_form.LMI_PAYMENT_AMOUNT.value 	= _PAYMENT_AMOUNT;
////			_form.LMI_PAYMENT_DESC.value 	= _PAYMENT_DESC;
////			_form.CLIENT_MAIL.value 	= _CLIENT_MAIL;
////                        _def                            = true;
//                        var c = $('<div class="box-modal" />');
//                        c.html($('.b-text').html());
//                        c.prepend('<div class="box-modal_close arcticmodal-close" onClick="$.arcticmodal(\'close\');return true;">X</div><div> Ваша смета готова </div><div><a onClick="$.arcticmodal(\'close\');return true;" class="ref_smeta" target="_blank" href="/smeta/'+_PAYMENT_NO+'">Получить</a></div>');
//                        $.arcticmodal({
//                            closeOnOverlayClick:false,
//                            content: c
//                        });
        var _data = {};
        // Rooms information

        // если город не изменяли
        if (_this.geo_id === 0) {
            if ($('#rus_select').is(':visible')) {
                _this.setGeo($('#rus_select select').val());
            } else if ($('#uk_select').is(':visible')) {
                _this.setGeo($('#uk_select select').val());
            } else {
                alert('Город не определен');
                return false;
            }
        }

           _data['rooms']= str_replace('null', '""',json_encode(_parent.rooms));
        
      //  _data['height'] = _parent.calcRoomHeight.getHeight();
        _data['geo_id'] = _parent.rooms.geo_id;
        _data['partner_id'] = _this.partner.id;
        _data['repair_param'] = '{ "ebp":' + _parent.calcRemontEBP.getEBPId() + ', "cc":' + _parent.calcRemontCC.getCCId() + ',  "nv":' + _parent.calcRemontNV.getNVId() + ' }';
//		_data["data"]["rooms"]              = _parent.calcRoomSize.getRoomsData();
//		_data["data"]["rooms_info"]              = _parent.calcRoomSize.getInfoData()[0];
//
//		// Size all rooms
////		_data["data"]["size"]               = _parent.calcRoomHeight.getHeight();
//		// Price
////		_data["price"]                      = _this.getPrice();
//		// Демонтажные работы
//		_data["data"]["TableDismantling"]   = _parent.calcRemontType.getTableDismantling().getTableData();
//		_data["data"]["TableDismantling_enable"]   = ''+$('#calc-remont-dismantling').prop('checked')+'';
//		// Монтажные работы
//		_data["data"]["TableInstallation"]  = _parent.calcRemontType.getTableInstallation().getTableData();
//		// Материалы
//		_data["data"]["materials"]          = _parent.calcRemontMaterials.getMaterialsData();

console.log(JSON.stringify(_data['rooms']));
        $(_form).empty();
        $(_form).append('<input type="hidden" name="rooms" value=\'' + JSON.stringify(_data['rooms']) + '\'>');
        $(_form).append('<input type="hidden" name="geo_id" value=\'' + _data['geo_id'] + '\'>');
        $(_form).append('<input type="hidden" name="repair_param" value=\'' + _data['repair_param'] + '\'>');
        $(_form).append('<input type="hidden" name="room_name" value=\'' + _parent.rooms.room_name + '\'>');
        _form.submit();
////                        return true;
////                        document.getElementById('calculator_submit').click();
//		}
    };

//	_this.grabberAllInfo = function () 
//	{
//		var _data = {  data : {} };
//		// Rooms information
//                console.log(_parent.calcPhoto.getPartners());
//		_data["data"]["partners_arr"]       = _parent.calcPhoto.getPartners();
//		_data["data"]["rooms"]              = _parent.calcRoomSize.getRoomsData();
//		_data["data"]["rooms_info"]              = _parent.calcRoomSize.getInfoData()[0];
//
//		// Size all rooms
////		_data["data"]["size"]               = _parent.calcRoomHeight.getHeight();
//		// Price
////		_data["price"]                      = _this.getPrice();
//		// Демонтажные работы
//		_data["data"]["TableDismantling"]   = _parent.calcRemontType.getTableDismantling().getTableData();
//		_data["data"]["TableDismantling_enable"]   = ''+$('#calc-remont-dismantling').prop('checked')+'';
//		// Монтажные работы
//		_data["data"]["TableInstallation"]  = _parent.calcRemontType.getTableInstallation().getTableData();
//		// Материалы
//		_data["data"]["materials"]          = _parent.calcRemontMaterials.getMaterialsData();
// 
//		return _data;
//	};

    _this.init = function()
    {
        // обнуление цен
//                        _this.update();
        // пересчет сметы
        $('.send_form').live("click", _this.changeSubmit);

        //		$(document).on("click", ".widget-2", _this.submit);
        //		$(document).on("click", ".widget-3", _this.submit);
//                var _callback = function(data){
//                    _this.work_piple	= data.count_work;
//                    _this.work_time	= data.char_work;
//                }
//                $.get('/load/getworkparam', '', _callback, "json");
//                //
//                    $.ajax({
//                       type: "POST",
//                       url: "/catalog/load/load",
//                       dataType: "json",
//                       success: function(data) {
//                           if(data){
//                                 instr = data.load.name2;
//                           }
//                       }
//                   })

    };
}
