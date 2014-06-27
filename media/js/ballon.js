/**
 * Label with products description
 * 
 */
jQuery.preloadImages = function () {
    var images = (typeof arguments[0] == 'object') ? arguments[0] : arguments;
    for (var i = 0; i < images.length; i++) {
        jQuery("<img>").attr("src", images[i]);
    }
}
var Ballon =
        {
            // Material instanse
//            loadend: false,
            materials: {},
//            windows: {},
//            count_load: 0,
//            count_ferst: true,
//            count_load_max: 0,
//            count_load_min: 0,
            // Selected matrial
            selected_materials: {},
            selected_materials_id: {},
            works: {},
            // Check enable
            enabled: {},
            // Prices of materials(prices[room_id][material_id] = ...)
            prices: {},
            
            // Get price
            group: function(){
                var dg = $('#cacl-price-group .active_econom').attr('id') || false;
                return dg;
            },
            getPrice: function()
            {
                var _price = 0;
                var _room_id, _material_id, _type;

                for (_room_id in Ballon.prices)
                {
                    for (_material_id in Ballon.prices[_room_id])
                    {
                        var chec = $('#calc-material-'+_room_id+'-'+_material_id).prop("checked");
                        if (Ballon.enabled[_room_id] != undefined && Ballon.enabled[_room_id][_material_id] == true && chec)
                            _price += Ballon.prices[_room_id][_material_id];
                    }
                }
                return _price;
            },
            show: function($obj, $room_id, $material_id, $id, p)
            {
                var _this = $obj,
                _product = Ballon.materials[$room_id][$material_id][$id] || false;
                _product.description = trim(_product.description);

                if (_product === false) {
                    $('#pr_'+$room_id+'_'+$material_id+'>a').html('');
                    Ballon.onEnabled($room_id, $material_id, false);
//                    if($('#calc-remont-groups>li>a').hasClass("remont_active")){
//                        if($('#cacl-price-group>li').hasClass("active_econom")){
//                            if($material_id >= 33 && $material_id <= 38){
//                                Ballon.showPrice($room_id, $material_id,$id,ref,[formatPrice(o)],[formatPrice(0)],false);
//                            }else{
//                                Ballon.showPrice($room_id, $material_id,$id,'/catalog/product/show/' + _product.id,0,false);
//                            }
//                        }
//                     }
                    $('.window-show-'+$room_id+'-'+$material_id+' img').attr('src', '/resources/images/pattern.png');
                    $('.window-show-'+$room_id+'-'+$material_id+' span.name a')
                            .attr('href', 'javascript:void();')
                            .attr('title', '<Товар не найден>')
                            .text('<Товар не найден>')
                    ;
//                    if($('.window-show-'+$room_id+'-'+$material_id).css('display') == 'none'){
//                        $('.window-show-'+$room_id+'-'+$material_id).show(200);
//                         setTimeout(function() {
//                                $('.window-show-'+$room_id+'-'+$material_id).hide(200);
//                            }, 3000);
//                    }
                } else {
                    Ballon.onEnabled($room_id, $material_id, true);
                    if ($material_id >= 33 && $material_id <= 38) {
                       var _material = new RoomsMaterials(window, $material_id, $room_id);
//                        var o33 = priceProfil($id,$room_id),
                        var o33 = _material.getMaterial().priceAll(_product.price,$id,getRoomByType($room_id)),
                            ref = '/catalog/product/show/' + Ballon.materials[$room_id][$material_id][$id].id+ '?pwindows=' + [formatPrice(o33)] + '&wwindows=' + $('#calc-room-width-6').val() + '&lwindows=' + $('#calc-room-length-6').val()+'&idprofil=' + $id + '&idcalc=' + $id+'&coeff='+Number($('#table_'+$('#table_country').val()).val());
                    }
                    
                    if ($material_id >= 33 && $material_id <= 38) {
                        var __price = [formatPrice(o33)];
                    } else {
                        var __price = [formatPrice(_product.price)];
                    }

                   if (_product.country1){
                        __price.push(_product.country1);   
                    } else if (_product.country2){
                        __price.push(_product.country2);
                    }else if ($material_id == 31){
                        __price.push(_product.co);
                    }
//                    _ballon.find(".price").text(__price.join(', ')).attr('title', __price.join(", "));
//           При движении полоски
                    if($('#calc-remont-groups>li>a').hasClass("remont_active")){
                        if($('#cacl-price-group>li').hasClass("active_econom")){
                            if($material_id >= 33 && $material_id <= 38){
                                Ballon.showPrice($room_id, $material_id,$id,ref,[formatPrice(o33)],[formatPrice(o33)],true);
                            }else{
                                Ballon.showPrice($room_id, $material_id,$id,'/catalog/product/show/' + _product.id,__price,formatPrice(Ballon.materials[$room_id][$material_id][$id].price),true);
                            }
                        }
                     }
                }
            },
            showPrice: function($room_id, $material_id,_id,ref,price,pric,show)
            {    
                var _show = true;
                if(show == false)_show=false;
                    $('#pr_'+$room_id+'_'+$material_id+'>a').html(pric+'');
                    $('#pr_'+$room_id+'_'+$material_id+'>a').attr('href',ref);
                if(_show){
                    
                if($('#calc-material-'+$room_id+'-'+$material_id+'').prop('checked')){
                    $('#pr_'+$room_id+'_'+$material_id+'>a').show();
                }else{
                    $('#pr_'+$room_id+'_'+$material_id+'>a').hide();
                }
              
                    $('.window-show-'+$room_id+'-'+$material_id+' img').attr('src', '/resources/images/products/80_80/'+Ballon.materials[$room_id][$material_id][_id]['image']);
                    $('.window-show-'+$room_id+'-'+$material_id+' span.name a')
                            .attr('href', ref)
                            .attr('title', '/catalog/product/show'+Ballon.materials[$room_id][$material_id][_id]['name'])
                            .text(Ballon.materials[$room_id][$material_id][_id]['name'].substr(0,30)+'...')
                    ;
                    var pr = '';
                    if(Ballon.materials[$room_id][$material_id][_id]['co'] != null)pr = ', '+Ballon.materials[$room_id][$material_id][_id]['co'];
                    $('.window-show-'+$room_id+'-'+$material_id+' p.description').text(Ballon.materials[$room_id][$material_id][_id]['description']);
                    $('.window-show-'+$room_id+'-'+$material_id+' span.price')
                            .attr('title', price+pr)
                            .text(price+pr);
                    if($('.window-show-'+$room_id+'-'+$material_id).css('display') == 'none'){
                        $('.window-show-'+$room_id+'-'+$material_id).show(200);
                         if($('#show_wind_all').attr('style') != 'opacity:0.5'){
                            setTimeout(function() {
                                   $('.window-show-'+$room_id+'-'+$material_id).hide(200);
                               }, 3000);
                        }
                    }
                }
                Ballon.stop(null, $room_id, $material_id, _id);
                Ballon.onEnabled($room_id, $material_id, true);
//                calc.update();
            },
            stop: function($obj, $room_id, $material_id, $id)
            {
                var _room = getRoomById($room_id);
                var _material = new RoomsMaterials(window, $material_id, _room);
                var _product = Ballon.materials[$room_id][$material_id][$id] || {};

                // Set price
                if (Ballon.prices[$room_id] == undefined)
                    Ballon.prices[$room_id] = {};

                // Update price
                if($.inArray(Number($material_id), [13,22,23,31,32,41]) != -1){
                     Ballon.prices[$room_id][Number($material_id)] = _material.getMaterial().priceAll($room_id,Number($material_id),$id);
                }else if(Number($material_id) >= 33 && Number($material_id) <= 38){
                    Ballon.prices[$room_id][Number($material_id)] = _material.getMaterial().priceAll(_product.price,$id,$room_id);
                }else{
                    Ballon.prices[$room_id][Number($material_id)] = _material.getMaterial().priceAll(_product.price,$id);
                }
                // Setted material id
                if (Ballon.selected_materials[$room_id] == undefined){
                    Ballon.selected_materials[$room_id] = {};
                    Ballon.selected_materials_id[$room_id] = {};   
                }
                if (Ballon.selected_materials_id[$room_id][$material_id] == undefined){
                    Ballon.selected_materials_id[$room_id][$material_id] = {}; 
                       
                }
                if(Ballon.works[$material_id] == undefined){
                    Ballon.works[$material_id] = {};
                }
                // Update material id
                Ballon.selected_materials[$room_id][$material_id] = _product.id;
                Ballon.selected_materials_id[$room_id][$material_id] = $id;
                if($material_id == 31){
                    if(_product.okras ) Ballon.works[$material_id] = [_product.okras, _product.vurav, _product.chtycat, _product.okras, _product.ystan_t, _product.ystan_osv];
                } 
                delete _material;

                // Recalculate
//                calc.update();
            },
            /*
             * Load materials
             */
            load: function($room_id, $material_id, $limit, $type, $params, profil_wind,loadd,off)
            {
               
//                if(!off){
//                    
//                        Ballon.count_load = Ballon.count_load+1;
//                        Ballon.count_load_max = Ballon.count_load_max+1;
//                        if(Ballon.count_load <= 2 && !Ballon.count_ferst){
//                             $('.calc_load').show();
//                          $('#help_count').show();                              
//                        }
//                        if(Ballon.count_ferst)Ballon.count_ferst = false;
////                        $('#progr').empty().append("<progress max='"+Ballon.count_load_max+"' value='"+Ballon.count_load+"'></progress>");
//                }
                                        
//                var _room_id = $room_id || -1;
//                var _material_id = $material_id || -1;
//                var _type = $type || 1;
//                var _limit = $limit || 21;
//                var _params = $params || {};
//                var  class_r = Ballon.group();
//                var  _id = 3;
               
//                if(class_r){
//                    if(class_r == 'calc-price-group-econom')    {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 0; else _id = 3;}
//                    if(class_r == 'calc-price-group-business')  {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 4; else _id = 10;}
//                    if(class_r == 'calc-price-group-premium')   {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 5; else _id = 17;}
//                }
                // загрузка новых материалов или требующих обновить
                
                if(Ballon.materials[_room_id] == undefined || loadd || (Ballon.materials[_room_id] != undefined && Ballon.materials[_room_id][_material_id] == undefined)){

                     var _url = "/catalog/load/materials";
                if(_material_id == 32 && _room_id == 4){
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type,
                        room: 'Кухня'
                    };
                }else if($.inArray(_material_id,[22,23]) != -1 && _room_id != 7){
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type,
                        room_S: window.calcRoomSize.getRoomSizeId([_room_id])
                    };
                }else{
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type
                    };
                }
                
                    var _callback = function(data){
//                         if(!off){
                        Ballon.count_load = Ballon.count_load-1;
//                        Ballon.count_load_min = Ballon.count_load_min+1;
                        if(Ballon.count_load == 0){
                            if(Ballon.count_ferst)Ballon.count_ferst =false;
//                            $('.calc_load').hide();
//                            $('#help_count').hide();                       
                        }
////                         $('#progr').empty().append("<progress max='"+Ballon.count_load_max+"' value='"+Ballon.count_load_min+"'></progress>");
//                         }
                         
                        if (Ballon.materials[_room_id] == undefined)
                            Ballon.materials[_room_id] = {};

                        if (Ballon.materials[_room_id][_material_id] == undefined)
                            Ballon.materials[_room_id][_material_id] = {};

                        // удаляем группу если нет материала
                        if(data.length == 0){
                            $('#calc-material-'+_room_id+'-'+_material_id).parents('div.item_material').remove();
                            return false;
                        }
                        for(var mar in  Ballon.materials[_room_id][_material_id]){
                            $.preloadImages('/resources/images/products/80_80/' + Ballon.materials[_room_id][_material_id][mar]['image']);
                        }
                        Ballon.materials[_room_id][_material_id] = data;
                        var _product= Ballon.materials[_room_id][_material_id][_id] || false;
                         if ($material_id >= 33 && $material_id <= 38) {
                                 var _material = new RoomsMaterials(window, $material_id, $room_id);
//                        var o33 = priceProfil($id,$room_id),
                                    var p = _material.getMaterial().priceAll(_product.price,_id,_room_id);
//                                var p       = priceProfil(_id,_room_id);
                                var ref     = '/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id+ '?pwindows=' + [formatPrice(p)] + '&wwindows=' + $('#calc-room-width-6').val() + '&lwindows=' +  $('#calc-room-length-6').val()+'&idprofil=' + profil_wind + '&idcalc=' + _id+'&coeff='+Number($('#table_'+$('#table_country').val()).val());
//                                if($('#calc-room-enable-6').prop('checked')){
//                                    var instaWork = new CalcTableInstallation(window);
//                                    var title = $('#cacl-room-title-'+_room_id).text();
//                                    console.log(title);
//                                    instaWork.addwindows(title,_room_id);
//                                }
                         }

                        if($('#calc-remont-groups>li>a').hasClass("remont_active")){
                            
                            // получаем цену
                            if ($material_id >= 33 && $material_id <= 38) {
                                var __price = [formatPrice(p)];
                            } else {
                                var __price = [formatPrice(_product.price)];
                            }
                            // добавляем к цене страну
                            if (_product.country1){
                                __price.push(_product.country1);   
                            } else if (_product.country2){
                                __price.push(_product.country2);
                            }else if ($material_id == 31){
                                __price.push(_product.co);
                            }

                            if(_material_id >= 33 && _material_id <= 38){
                                Ballon.showPrice(_room_id, _material_id,_id,ref,[formatPrice(p)],[formatPrice(p)]);
                            }else if(Ballon.materials[_room_id][_material_id][_id] != undefined){
                                Ballon.showPrice(_room_id, _material_id,_id,'/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id, __price,formatPrice(Ballon.materials[_room_id][_material_id][_id].price));
                            }
                        }
                        
                    };

                    $.extend(_data, _params);
                    $.get(_url, _data, _callback, "json");
                }else{ 
//                     if(!off){
                        Ballon.count_load = Ballon.count_load-1;
//                        Ballon.count_load_min = Ballon.count_load_min+1;
                        if(Ballon.count_load == 0){
//                            $('.calc_load').hide();
//                            $('#help_count').hide();                           
                        }
//                     }
                        
                        
                        if(Ballon.materials[_room_id] == undefined || Ballon.materials[_room_id][_material_id] == undefined || Ballon.materials[_room_id][_material_id][0] == undefined){
                            $('#calc-material-'+_room_id+'-'+_material_id).parents('div.item_material').remove();
                            return false;
                        }
                        
                        if($('#calc-remont-groups>li>a').hasClass("remont_active")){
                            var _product= Ballon.materials[_room_id][_material_id][_id] || false;
                
                            
                            if ($material_id >= 33 && $material_id <= 38) {
                                var __price = [formatPrice(p)];
                            } else {
                                var __price = [formatPrice(_product.price)];
                            }
                            if (_product.country1){
                                __price.push(_product.country1);   
                            } else if (_product.country2){
                                __price.push(_product.country2);
                            }else if ($material_id == 31){
                                __price.push(_product.co);
                            }

                            if(_material_id >= 33 && _material_id <= 38){

                                var p       = priceProfil(_id,_room_id);
                                var ref     = '/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id+ '?pwindows=' + [formatPrice(p)] + '&wwindows=' + $('#calc-room-width-6').val() + '&lwindows=' + $('#calc-room-length-6').val()+'&idprofil=' + profil_wind + '&idcalc=' + _id+'&coeff='+Number($('#table_'+$('#table_country').val()).val());
                            
                                Ballon.showPrice(_room_id, _material_id,_id,ref,[formatPrice(p)],[formatPrice(p)]);
                            }else if(Ballon.materials[_room_id][_material_id].length > 0 ){
                                if(Ballon.materials[_room_id][_material_id][_id])
                                    Ballon.showPrice(_room_id, _material_id,_id,'/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id, __price,formatPrice(Ballon.materials[_room_id][_material_id][_id].price));
                            }
                        }
                }
            },
            firstload: function(arr_rooms,arr_mat_roomid_0,arr_mat_roomid_1,arr_mat_roomid_2,arr_mat_roomid_3,arr_mat_roomid_4,arr_mat_roomid_5){
                    var rooms = arr_rooms || false;
                    var room_0_m = arr_mat_roomid_0||false;
                    var room_1_m = arr_mat_roomid_1||false;
                    var room_2_m = arr_mat_roomid_2||false;
                    var room_3_m = arr_mat_roomid_3||false;
                    var room_4_m = arr_mat_roomid_4||false;
                    var room_5_m = arr_mat_roomid_5||false;
                    var data = new Array();
                    
                   if(rooms){
                        for(var room in rooms){
                            if(rooms[room] == -1){
                                if(room_0_m){
                                    for(var material0 in room_0_m){
                                        if(Ballon.loadall(rooms[room], room_0_m[material0], 21, 1, 0, 0,true,true)){
                                            data[data.length] = Ballon.loadall(rooms[room], room_0_m[material0]);                                    
                                        }
                                    }
                                }
                            }
                            if($.inArray(rooms[room], [1,2,3,4,5]) != -1){
                                if(room_1_m){
                                    for(var material1 in room_1_m){
                                        if(Ballon.loadall(rooms[room], room_1_m[material1], 21, 1, 0, 0,true,true))
                                        data[data.length] = Ballon.loadall(rooms[room], room_1_m[material1]);
                                    }
                                }
                            }
                            if(rooms[room] == 6){
                                if(room_2_m){
                                    for(var material2 in room_2_m){
                                        if(Ballon.loadall(rooms[room], room_2_m[material2], 21, 1, 0, 0,true,true))
                                        data[data.length] = Ballon.loadall(rooms[room], room_2_m[material2]);
                                    }
                                }
                            }
                            if(rooms[room] == 7){
                                if(room_3_m){
                                    for(var material3 in room_3_m){
                                        if(Ballon.loadall(rooms[room], room_3_m[material3], 21, 1, 0, 0,true,true))
                                        data[data.length] = Ballon.loadall(rooms[room], room_3_m[material3]);
                                    }
                                }
                            }
                            if(rooms[room] == 8){
                                if(room_4_m){
                                    for(var material4 in room_4_m){
                                        if(Ballon.loadall(rooms[room], room_4_m[material4], 21, 1, 0, 0,true,true))
                                        data[data.length] = Ballon.loadall(rooms[room], room_4_m[material4]);
                                    }
                                }
                            }
                            if(rooms[room] == 9){
                                if(room_5_m){
                                    for(var material5 in room_5_m){
                                        if(Ballon.loadall(rooms[room], room_5_m[material5], 21, 1, 0, 0,true,true))
                                        data[data.length] = Ballon.loadall(rooms[room], room_5_m[material5]);
                                    }
                                }
                            }
                        }
                       Ballon.get_materials(data);
                   }
            },
            get_materials: function(data){
                    var _url = "/catalog/load/materialsall";
                    var _id = 3;
                    var class_r = Ballon.group();
                    
                    var _callback = function(data){
                         for(var _room_id in data){
                                if (Ballon.materials[_room_id] == undefined)
                                    Ballon.materials[_room_id] = {};
                                
                                for(var _material_id in data[_room_id]){
                                    // определяем положение ползунка
                                    // для потолка (31) 0-4-5 остальные 3-10-17
                                    if(class_r){
                                        if(class_r == 'calc-price-group-econom')    {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 0; else _id = 3;}
                                        if(class_r == 'calc-price-group-business')  {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 4; else _id = 10;}
                                        if(class_r == 'calc-price-group-premium')   {if(_material_id == 31 && $('#calc-remont-groups .remont_active').attr('id') == 'calc-remont-group-cosmetic')_id = 5; else _id = 17;}
                                    }
                    
                                    if (Ballon.materials[_room_id][_material_id] == undefined)
                                        Ballon.materials[_room_id][_material_id] = {};
                                    
                                    // удаляем группу если нет материала
                                    if(data.length == 0){
                                        $('#calc-material-'+_room_id+'-'+_material_id).parents('div.item_material').remove();
                                        return false;
                                    }
                                    Ballon.materials[_room_id][_material_id] = data[_room_id][_material_id];
                                    
                                    for(var mar in  Ballon.materials[_room_id][_material_id]){
                                        if(Ballon.materials[_room_id][_material_id][mar]['image']){                                            
                                            $.preloadImages('/resources/images/products/80_80/' + Ballon.materials[_room_id][_material_id][mar]['image']);
                                        }
                                    }
                                    
//                                    var _product= Ballon.materials[_room_id][_material_id][_id] || false;
                                    
                                    // окна будем разбираться(!)
//                                     if (_material_id >= 33 && _material_id <= 38) {
//                                             var _material = new RoomsMaterials(window, _material_id, _room_id);
//                                                var p = _material.getMaterial().priceAll(_product.price,_id,_room_id);
//                                            var ref     = '/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id+ '?pwindows=' + [formatPrice(p)] + '&wwindows=' + $('#calc-room-width-6').val() + '&lwindows=' +  $('#calc-room-length-6').val()+'&idprofil=' + profil_wind + '&idcalc=' + _id+'&coeff='+Number($('#table_'+$('#table_country').val()).val());
            //                        if($('#calc-remont-groups>li>a').hasClass("remont_active")){
            //                            
            //                            // получаем цену
            //                            if ($material_id >= 33 && $material_id <= 38) {
            //                                var __price = [formatPrice(p)];
            //                            } else {
            //                                var __price = [formatPrice(_product.price)];
            //                            }
            //                            // добавляем к цене страну
            //                            if (_product.country1){
            //                                __price.push(_product.country1);   
            //                            } else if (_product.country2){
            //                                __price.push(_product.country2);
            //                            }else if ($material_id == 31){
            //                                __price.push(_product.co);
            //                            }
            //
            //                            if(_material_id >= 33 && _material_id <= 38){
            //                                Ballon.showPrice(_room_id, _material_id,_id,ref,[formatPrice(p)],[formatPrice(p)]);
            //                            }else if(Ballon.materials[_room_id][_material_id][_id] != undefined){
            //                                Ballon.showPrice(_room_id, _material_id,_id,'/catalog/product/show/' + Ballon.materials[_room_id][_material_id][_id].id, __price,formatPrice(Ballon.materials[_room_id][_material_id][_id].price));
            //                            }
            //                        }
            //                        
//                                     }
                                }
                             
                         }
                         Ballon.loadend = true;
                         
                    };
                    var datas = new Object();
                    for (i = 0; i < data.length; i++) {  
                        datas['mat[' + i + '][type_id]'] = data[i].type_id;
                        datas['mat[' + i + '][room_id]']  = data[i].room_id;
                        datas['mat[' + i + '][type]']  = data[i].type;
                        datas['mat[' + i + '][room_S]']  = data[i].room_S;
                    }
                    $.get(_url, datas, _callback, "json");
            },
            loadall: function($room_id, $material_id)
            {
                var _room_id = $room_id || -1;
                var _material_id = $material_id || -1;
                var _type = 1;
                var _limit = 21;
                var  class_r = Ballon.group();
                // обои определяем тип
                if($material_id == 13){
                    if(class_r == 'calc-price-group-econom'){
                        _type = 2;
                    }else if(class_r == 'calc-price-group-business'){
                       
                    }else if(class_r == 'calc-price-group-premium'){
                        _type = 5;
                    }
                // пол определаем тип
                }else if($material_id == 32){
                    if(class_r == 'calc-price-group-econom'){
                        if($.inArray($room_id,[1,2,3,4,5]) != -1){
                            _type = 2;
                        }else if($.inArray($room_id,[8,9]) != -1){
                            _type = 3;
                        }
                    }else if(class_r == 'calc-price-group-business'){
                       if($.inArray($room_id,[1,2,3,4,5,6,7]) != -1){
                            _type = 2;
                        }else if($.inArray($room_id,[8,9]) != -1){
                            _type = 3;
                        }
                    }else if(class_r == 'calc-price-group-premium'){
                        if($.inArray($room_id,[1,2,3,4,5]) != -1){
                            _type = 5;
                        }else if($.inArray($room_id,[6,7,8,9]) != -1){
                            _type = 3;
                        }
                    }
                }
                
                if(_material_id == 32 && _room_id == 6){
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type,
                        room: 'Кухня'
                    };
                }else if($.inArray(_material_id,[22,23]) != -1 && _room_id < 7){
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type,
                        room_S: window.calcRoomSize.getRoomSizeId([_room_id], true)
                    };
                }else{
                    var _data = {
                        type_id: _material_id,
                        room_id: _room_id,
                        limit: _limit,
                        type: _type
                    };
                }
                return _data;
                
            },
            onEnabled: function($room_id, $material_id, $enabled, $work_update)
            {
                if (Ballon.enabled[$room_id] == undefined)
                    Ballon.enabled[$room_id] = {};

                Ballon.enabled[$room_id][$material_id] = $enabled;
//                $('#calc-material-'+$room_id+'-'+$material_id).attr('checked', $enabled);
                if($('.item_material input:checked').length == 0){
                    $('#calc-material-all').attr('checked', false);
                }else{
                    $('#calc-material-all').attr('checked', true);                    
                }
                 if($('#calc-material-'+$room_id+'-'+$material_id).prop('checked')){
                    $('#pr_'+$room_id+'_'+$material_id+'>a').attr('style','display:block');
                }else{
                    $('#pr_'+$room_id+'_'+$material_id+'>a').attr('style','display:none');
                }
                // Update price
                calc.update();
                
                if($work_update){
                    var calcTableDismantling = calcRemontType.getTableDismantling();
                    calcTableDismantling.update();
                    var calcTableInstallation = calcRemontType.getTableInstallation();
                    calcTableInstallation.update();
                }
            },
            init: function()
            {
                Ballon.prices = {};
                // отобразить картинки с материалами
                $(document).on("click", "#show_wind_all", function (){
                    if($(this).attr('data-vis') == 1){
                        $(this).attr('style', 'opacity:1');
                        $(this).attr('data-vis', '0');
                        $('.window-show-all').hide(400);
                        $(this).text('Показать картинки');
                    }else{
                        $(this).attr('data-vis', '1');
                        $(this).attr('style', 'opacity:0.5');
                        $('.window-show-all').show(400);
                        $(this).text('Скрыть картинки');
                    }
                });
                // загрузка материалов
                var arr_rooms = [-1,1,2,3,4,5,6,7,8,9];
                var arr_mat_roomid_0 = [1,2,5,6,7,8,9,10,11,12,15,24,25,26,27,28,29,30];
                var arr_mat_roomid_1=[13,31,22,23,32];
                var arr_mat_roomid_2=[13,31,41,23,22,32];
                var arr_mat_roomid_3=[13,31,32,32];
                var arr_mat_roomid_4=[13,16,17,19,20,21,40,31,18,32];
                var arr_mat_roomid_5=[13,32,18,31,32];
                Ballon.firstload(arr_rooms,arr_mat_roomid_0,arr_mat_roomid_1,arr_mat_roomid_2,arr_mat_roomid_3,arr_mat_roomid_4,arr_mat_roomid_5);
            }
        };
