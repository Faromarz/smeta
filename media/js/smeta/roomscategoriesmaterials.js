/**
 * Обэкт для списка, например обоев, плинтусов ...
 *
 * @version 1.0
 * @todo 	Описать pticeAll для материалов
 */
//var o33;
////var numberProfil;
//var side;
//var side_class;
//var style;
//var dis;

/**
 * 
 * @param {object} $parent
 * @param {integer} $cat_id
 * @param {object} $room
 * @param {array} $param
 * @returns {boolean}
 */
function RoomsCategoriesMaterials($parent, $cat_id, $room, $param)
{
//    var _this = this;
//    var _parent = $parent;
//    var _param = $param || {};
//    _this.cat_id = $cat_id || 1;
////    _this.material_id =  $material_id || 1;
////    var _type = $type || 1;
//    var _room = $room;
////    var _room_id;
//    _this.name = _parent.categories[_this.cat_id].name;
//    _this.enable = _room.enable;
//    _this.material = 10;
//    _this.materials = smeta.materials[cat_id];
//
//    _this.setEnable = function($enable) {
//        _this.enable = $enable;
//    };
//    _this.getCategories = function() {
//        return _parent.categories[_this.cat_id];
//    };
//    _this.init = function() {
////            _room = $room;
////            _room_id = _room.getId();
//    };
//    _this.update = function() {
//
//        var _id_index = _room.type + '-' + _room.id + '-' + _this.cat_id;
////        var _is_enabled = _room.getEnable();
//        var _i;
//        var _html = '';
////        var _value =11;
////        var rooms = profil.length;
////        var class_r = $('#cacl-price-group .active_econom').attr("id");
////        var profil_wind = 2;
//
////        if (_room_id <= rooms) {
////            var _room_params = "{width: " + _room.getWidth() + ", length: " + _room.getLength() + "}";
////        }
//        _html += '<div class="materials_room_option" id="materials-' + _id_index + '">';
////        var add_class = '';
////        if (_parent.calcRemontMaterials.get_count_materials_show() > 2) {
////            var add_class = ' hide_mater';
////        }
////        if (_material_id >= 33 && _material_id <= 38) {
////            _html += " class='block_windows item_material" + add_class + "'>";
////            _is_enabled = true;
////        } else {
////            _html += " class=\"item_material" + add_class + "\">";
////        }
////        if (
////                (
////                        $.inArray(_parent.calcRemontPrice.getGroup(), _materials[_material_id].remontTypeDef) != -1
////                        &&
////                        $.inArray(_parent.calcRemontType.getRemontType(), _materials[_material_id].remontTypeDef) != -1
////                        )
////                ||
////                (
////                        _materials[_material_id].remontTypeDef2 != ''
////                        &&
////                        $.inArray(_parent.calcRemontPrice.getGroup(), _materials[_material_id].remontTypeDef2) != -1
////                        &&
////                        $.inArray(_parent.calcRemontType.getRemontType(), _materials[_material_id].remontTypeDef2) != -1
////                        )
////                ) {
////            _is_enabled = true;
////        } else {
////            _is_enabled = false;
////        }
////        if (!_parent.calcRemontMaterials.get_user_eneble()) {
////            _is_enabled = false;
////        }
//        _html += '<div class="materials_room_option_header">';
//        _html += '   <p>' + (_param.name ? _param.name : _this.name) + '</p>';
//        _html += '   <div class="ignore' + (_this.enable ? '' : 'd') + '_4 on-off-category" data-room-id="' + _room.id + '" data-room-type="' + _room.type + '" data-cat-id="' + _this.cat_id + '"></div>';
//        _html += '                    </div>';
//        if (_parent.categories[_this.cat_id].group.length > 0) {
//            _html += '<select class="selectbox">';
//            for (_i in _parent.categories[_this.cat_id].group) {
//                _html += '<option id="val' + _i + '" value="' + _parent.categories[_this.cat_id].group[_i].id + '">' + _parent.categories[_this.cat_id].group[_i].name + '</option>';
//            }
//            _html += '</select>';
//        } else {
//            _html += ' <div class="materials_room_option_menu"></div>';
//        }
//        _html += '     <div class="materials_room_option_slider">';
//        _html += '         <div class="slider-materials-' + _id_index + '" style="position: relative">';
//        _html += '             <div class="ui-slider-handle ui-state-default ui-corner-all"><h6 class="slider_price price-materials-' + _id_index + '">0 р</h6></div>';
//        _html += '         </div>';
//        _html += '<div class="slider_img">';
//        _html += '   <div class="slider_about">';
//        _html += '        <a href="#">Обои Esta Home 326115 Bloomingdale</a>';
//        _html += '        <h6>Нидерланды</h6>';
//        _html += ' </div>';
//        _html += ' </div>';
//        _html += '     </div>';
//        _html += '     <div class="x"></div>';
//        _html += '     <h1>0 рулонов =</h1>';
//        _html += '     <h2>0 р.</h2>';
//        _html += '</div>';
//        _html += '<script>';
//        _html += "$('.slider-materials-" + _id_index + "').slider({";
//        _html += "min: 0,";
//        _html += "orientation : 'vertical',";
//        _html += "value: " + _this.material + ",";
//        _html += "max: 20,";
//        _html += "step: 1,";
//        _html += "create: function () {";
////                                                                            _html += "Ballon.load("+_room.getId()+", "+_material_id+", 21, "+_type+', '+_room_params+","+profil_wind+");";
//        _html += "},";
//        _html += "slide: function (e, ul) { ";
//        _html += '   $(".price-materials-' + _id_index + '").text(ul.value+\' р\');';
//        _html += "   smeta.rooms[0].categories[" + _param.number + "].material = ul.value;";
//        _html += "    console.log('изменили  материал " + _param.number + "');";
////                            _html +=     "var _item = $(this).parents('.item_material');" +
////                                        "o33 = priceProfil(0, "+_room_id+");" +
////                                        "if("+_material_id+">=33 && "+ _material_id +"<=38){" +
////                                            " Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, o33);" +
////                                        "}else {Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, 0);} ";
//        _html += "},";
//        _html += "stop : function (e, ul) {";
////                            _html += "var _item = $(this).parents('.item_material');  Ballon.stop(_item, "+_room_id+", "+_material_id+", ul.value); ";
//        _html += "},";
//        _html += "});";
//
////                                _html += '$("#calc-material-'+_id_index+'").on("change", function() { Ballon.onEnabled('+_room_id+', '+_material_id+', this.checked, true) })';
//        _html += '</script>';
//        return _html;
////        _html += "<span title='" + _this.getMaterial().title + "'>" + _this.getMaterial().title + "</span>";
////        _html += '<input type="checkbox" id="calc-material-' + _id_index + '"  ' + (_is_enabled ? 'checked="checked"' : '') + '><label for="calc-material-' + _id_index + '"></label>';
////        if (_this.getMaterial().title == 'Обои' && _material_id == 13) {
////            if (class_r == 'calc-price-group-econom') {
////                type = 2;
////            } else if (class_r == 'calc-price-group-business') {
////                _type = 1;
////            } else if (class_r == 'calc-price-group-premium') {
////                _type = 5;
////            }
////            _html += "<ul id='cacl-price-wallpaper' class='cacl_select_type m_13_" + _room_id + "' data-id='" + _room_id + "'>";
////            _html += "<li data-id='13' " + (class_r == 'calc-price-group-econom' ? 'class="active_premium"' : '') + "><a data-id='2' id=" + _room_id + " href='javascript: void(0)' ><span>Виниловые</span></a></li>";
////            _html += "<li data-id='13' " + (class_r == 'calc-price-group-business' ? 'class="active_premium"' : '') + "><a data-id='1' id=" + _room_id + " href='javascript: void(0)' ><span>Флизелиновые</span></a></li>";
////            _html += "<li data-id='13'><a data-id='3' id=" + _room_id + " href='javascript: void(0)'><span>Текстильные</span></a></li>";
////            if ($(".active_econom").attr("id") === "calc-price-group-business")
////                _html += "<li data-id='13'><a data-id='4' id=" + _room_id + " href='javascript: void(0)'><span>Флоковые</span></a></li>";
////            if ($(".active_econom").attr("id") === "calc-price-group-premium")
////                _html += "<li data-id='13' " + (class_r == 'calc-price-group-premium' ? 'class="active_premium"' : '') + "><a data-id='5' id=" + _room_id + " href='javascript: void(0)' ><span>Натуральные</span></a></li>";
////            if ($(".active_econom").attr("id") === "calc-price-group-econom")
////                _html += "<li data-id='13'><a data-id='6' id=" + _room_id + " href='javascript: void(0)'><span>Бумажные</span></a></li>";
////            if ($.inArray(_room.getType(), [2, 3, 4, 5]) != -1) {
////                _html += "<li data-id='13'><a data-id='7' id=" + _room_id + " href='javascript: void(0)'><span>Плитка</span></a></li>";
////            }
////            _html += "</ul>";
////        } else if (_this.getMaterial().title == 'Пол' && _material_id == 32) {
////            if ($.inArray(_room.getType(), [1, 2, 3]) != -1) {
////                if (class_r == 'calc-price-group-econom') {
////                    if (_room.getType() == 1) {
////                        _type = 2;
////                    } else {
////                        _type = 1;
////                    }
////                } else if (class_r == 'calc-price-group-business') {
////                    _type = 2;
////                } else if (class_r == 'calc-price-group-premium') {
////                    if (_room.getType() == 1) {
////                        _type = 5;
////                    } else {
////                        _type = 3;
////                    }
////                }
////            } else if ($.inArray(_room.getType(), [4, 5]) != -1) {
////                _type = 3;
////            }
////            _html += "<ul id='cacl-price-floor' class='cacl_select_type m_32_" + _room_id + "'>";
////            _html += "<li id='1' data-id='32'" + (_type == 1 ? 'class="active_min"' : '') + "><a data-id='1' id=" + _room_id + " href='javascript: void(0)'><span>Линолеум</span></a></li>";
////            _html += "<li id='2' data-id='32' " + (_type == 2 ? 'class="active_min"' : '') + "><a data-id='2' id=" + _room_id + " href='javascript: void(0)' ><span>Ламинат</span></a></li>";
//////                              if((_room_id == 4 && $('#cacl-room-title-4').text() != 'Bанна')||_room_id != 5)  _html += "<li id='4' data-id='32' ><a data-id='4' id="+_room_id+" href='javascript: void(0)'><span>Пробка</span></a></li>";
////            if ((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна') || _room.getType() != 5)
////                _html += "<li id='5' data-id='32' " + (_type == 5 ? 'class="active_min"' : '') + "><a data-id='5' id=" + _room_id + " href='javascript: void(0)'><span>Паркет</span></a></li>";
////            if ((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна') || _room.getType() != 5)
////                _html += "<li id='6' data-id='32' " + (_type == 6 ? 'class="active_min"' : '') + "><a data-id='6' id=" + _room_id + " href='javascript: void(0)'><span>Массив</span></a></li>";
////            if ((_room.getType() == 4 && $('#cacl-room-title-6 span').text() != 'Bанна') || _room.getType() != 5)
////                _html += "<li id='7' data-id='32' " + (_type == 7 ? 'class="active_min"' : '') + "><a data-id='7' id=" + _room_id + " href='javascript: void(0)' ><span>Модули</span></a></li>";
////
////            if (
////                    (_room.getType() != 1)
////                    ||
////                    (_room.getType() == 3 && $('.remont_active').attr("id") === 'calc-remont-group-capital')
////                    ||
////                    (_room.getType() == 4)
////                    ||
////                    (_room.getType() == 5 && $('.remont_active').attr("id") === 'calc-remont-group-capital')
//////                                    
////                    ) {
////                _html += "<li id='3' data-id='32' " + (_type == 3 ? 'class="active_min"' : '') + "><a data-id='3' id=" + _room_id + " href='javascript: void(0)'><span>Плитка</span></a></li>";
////            }
////            _html += "</ul>";
////
////        } else if (_material_id >= 33 && _material_id <= 38) {
////
////            if (profil.length > 0) {
////                _html += "<ul id='cacl-price-window' class='cacl_select_type'>";
////            }
////            for (var i = 0; i < profil.length; i++) {
////                if (i in profil) {
////                    if (class_r == 'calc-price-group-econom' && profil[i][1] == 2)
////                        profil_wind = 2;
////                    else if (class_r == 'calc-price-group-business' && profil[i][1] == 3)
////                        profil_wind = 3;
////                    else if (class_r == 'calc-price-group-premium' && profil[i][1] == 4)
////                        profil_wind = 4;
////                    var clas = '';
////                    // при обновлении выбираем нужный блок
////                    if (class_r == 'calc-price-group-econom' && profil[i][1] == 2)
////                        clas = 'class="active_premium"';
////                    else if (class_r == 'calc-price-group-business' && profil[i][1] == 3)
////                        clas = 'class="active_premium"';
////                    else if (class_r == 'calc-price-group-premium' && profil[i][1] == 4)
////                        clas = 'class="active_premium"';
////                    _html += "<li data-id='" + _material_id + "'><a data-id='" + profil[i][1] + "' id='" + _room_id + "'  href='javascript: void(0)' " +
////                            clas + "><span>" + profil[i][0] + "</span></a></li>";
////                }
////            }
////        }
////        if (profil.length > 0) {
////            _html += "</ul>";
////        }
////        ///       slider   
////        _html += '<div class="demo">';
////        _html += '<div id="slider-' + _id_index + '" class="slider">';
////        _html += '<img alt="" src="/resources/images/slider_left_bg.png">';
////        _html += '<img alt="" src="/resources/images/slider_right_bg.png">';
////        _html += '</div></div>';
////        _html += '<span class="pric_r" id="pr_' + _room_id + '_' + _material_id + '">';
////        _html += '<a href="" target="_blank"></a></span>' +
////                '<div id="' + side + '" class="div_' + side_class + '_perview window-show-' + _room_id + '-' + _material_id + ' window-show-all" style="' + style + 'display: ' + dis + '; top: -12px; opacity: 1; overflow: hidden; height: 105px; margin: 0px; padding: 0px; width: 244px;">' +
////                '<table class="left_prew">' +
////                '<tbody><tr>' +
////                '<td>' +
////                '<img alt="" class="image" height="80px" width="80px" src="/resources/images/preview_img.png" onerror="this.src =\'/resources/images/pattern.png\'">' +
////                '</td>' +
////                '<td><div style="position:relative;">' +
////                '<span class="name" style="font-size: 11px;width: 123px;height: 27px;"><a href="/catalog/product/show/34528" target="_blank" title="" class=""></a></span>' +
////                '<p class="description"></p>' +
////                '<span  style="font-size: 11px;width: 123px;position:static" class="price" title=""></span>' +
////                '</div></td>' +
////                '</tr>' +
////                '</tbody></table>' +
////                '</div>' +
////                '';//side
//////                            }
////
////        _html += '</div>';
////        _html += '<script>';
////        _html += "$('#slider-" + _id_index + "').slider({";
////        _html += "min: 0,";
////        _html += "value: " + _value + ",";
////        _html += "max: 20,";
////        _html += "step: 1,";
////        _html += "create: function () { Ballon.load(" + _room_id + ", " + _material_id + ", 21, " + _type + ', ' + _room_params + "," + profil_wind + ");},";
////        _html += "slide: function (e, ul) { " +
////                "var _item = $(this).parents('.item_material');" +
////                "o33 = priceProfil(0, " + _room_id + ");" +
////                "if(" + _material_id + ">=33 && " + _material_id + "<=38){" +
////                " Ballon.show(_item, " + _room_id + ", " + _material_id + ", ul.value, o33);" +
////                "}else {Ballon.show(_item, " + _room_id + ", " + _material_id + ", ul.value, 0);} },";
////        _html += "stop : function (e, ul) { var _item = $(this).parents('.item_material');  Ballon.stop(_item, " + _room_id + ", " + _material_id + ", ul.value); },";
////        _html += "});";
////
////        _html += '$("#calc-material-' + _id_index + '").on("change", function() { Ballon.onEnabled(' + _room_id + ', ' + _material_id + ', this.checked, true) })';
////        _html += '</script>';
////        _parent.calcRemontMaterials.add_count_materials_show();
////        _item = $(this).parents('.item_material');
////
////        return _html;
////
////        $('.materials_room_for_options[data-type="1"][data-id="1"]').append(_html);
//    };
//
//    _this.init();
//
//    return true;

}