/**
 * Category
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {object} $room
 * @param {array}  $params
 */
function Category($parent, $room, $params)
{
    var _this = this;
    var _parent = $parent;
    var _room = $room;
    var _params = $params;
    var _id = _params.id;
    var _name = _params.name;
    var _enable = Number(_params.enable) || false;
    var _childrens = _params.childrens || null;
    var _childrenId = Number(_params.childrenId) || null;
    var _repairRateCombination = _params.repair_id_rate_id.split(',');
//    var _materials = _params.materials || [];
    var _material = _params.material || null;// тут будет new Material(_params.material);

    // ID категории
    _this.getId = function() {
        return _id;
    };
    // название категории
    _this.getName = function() {
        return _name;
    };
    // on||off  категория
    _this.setEnable = function($enable) {
        _enable = $enable;
        if ($enable) {
            $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').removeClass('ignored_4');
            $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').addClass('ignore_4');
        } else {
            $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').removeClass('ignore_4');
            $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').addClass('ignored_4');
        }
    };
    // on||off  категория
    _this.getEnable = function() {
        return _enable;
    };
    // выбранный материал
    _this.getMaterial = function(){
        return _material;
    };
    // параметры для сметы
    _this.getParams = function() {
        var params = {
            id: _this.getId(),
            enable: _this.getEnable()
        };
        if (_childrenId !== null) {
            params['childrenId'] =  _childrenId;
        }
        return params;
    };
    // html категории
    _this.getHTML = function($material) {
        
//        if (_this.getMaterial() === null) {
//            return '';
//        }
        var _id_index = _room.getType() + '-' + _room.getId() + '-' + _this.getId();
        var _html = '';
        _html += '<'+(_parent.smetaId === null ? 'div' : 'li') +' class="materials_room_option" id="materials-' + _id_index + '">';
        _html += '  <div class="materials_room_option_header">';
        _html += '      <p>' +  _this.getName() + '</p>';
        _html += '      <div class="ignore' + (_this.getEnable() ? '' : 'd') + '_4 material-enable" data-room-id="' + _room.getId() + '" data-room-type="' + _room.getType() + '" data-cat-id="' + _this.getId() + '"></div>';
        _html += '  </div>';

        if (_childrens !== null) {
            _html += '<select class="selectbox" data-cat-id="' + _this.getId() + '"   data-room-id="' + _room.getId() + '" data-room-type="' +_room.getType() + '">';
            $.each(_childrens, function(key, cat) {
                _html += '<option id="val' + key + '" value="' + cat.id + '"' + (_childrenId  === Number(cat.id) ? 'selected' : '') + '>' + cat.name + '</option>';
                if(_childrenId  === Number(cat.id)){
                    $.each(_room.materials, function (k, material) {
                        if (material.getCategory() == Number(cat.id) && material.getSelected() == 1) {
                            $material = material;
                        };
                    });
                };
            });
            _html += '</select>';
        } else {
            _html += ' <div class="materials_room_option_menu"></div>';
        }
        _html += '<div class="materials_room_option_slider">';
        _html += '    <div class="slider-materials-' + _id_index + '" style="position: relative">';
        _html += '        <div class="ui-slider-handle ui-state-default ui-corner-all"><h6 class="slider_price price-materials-' + _id_index + '">' + $material.getPrice() + ' р</h6></div>';
        _html += '    </div>';
        _html += '    <div class="slider_img" style="background-image: url(/media/img/material/'+$material.getImg()+')">';
        _html += '    <div class="slider_about">';
        _html += '        <a href="/materials/view/'  + $material.getId()+'" class="mat-name-' + _id_index + '">'  + $material.getName()+'</a>';
        _html += '        <h6 class="city-name-' + _id_index + '">' + $material.getCountry()+'</h6>';
        _html += '    </div>';
        _html += '</div>';
        _html += '     <div class="x"></div>';
        _html += '     <h1>'+$material.count_material()+' '+$material.getCount_text_ready()+'  =</h1>';
        _html += '     <h2 class="mat-price-all-' + _id_index + '">'+$material.getAllPrice()+' р.</h2>';
        _html += '</div>';
        _html += '<script>';
        _html += "$('.slider-materials-" + _id_index + "').slider({";
            _html += "min: 0,";
            _html += "orientation : 'vertical',";
            _html += "value: " + 5 + ",";
            _html += 'max: ' + 21 + ',';
            _html += "step: 1,";
            _html += "create: function () {},";
//        _html += "slide: function (e, ul) { ";
//        _html += '   $(".price-materials-' + _id_index + '").text(number_format(smeta.rooms.room[0].categories[' + _param.number + '].getMaterials()[ul.value].price, \'2\', \',\', \' \') +\' р.\');';
//        _html += '   $(".mat-price-all-' + _id_index + '").text(number_format(smeta.rooms.room[0].categories[' + _param.number + '].material_count * smeta.rooms.room[0].categories[' + _param.number + '].getMaterials()[ul.value].price, \'2\', \',\', \' \') +\' р.\');';
//        _html += '   $(".mat-name-' + _id_index + '").text(smeta.rooms.room[0].categories[' + _param.number + '].getMaterials()[ul.value].name);';
//        _html += '   $(".city-name-' + _id_index + '").text(smeta.rooms.room[0].categories[' + _param.number + '].getMaterials()[ul.value].city_name);';
//        _html += '   $("#materials-' + _id_index + '").find(".slider_img").css( "background-image","url(/media/img/material/"+smeta.rooms.room[0].categories[' + _param.number + '].getMaterials()[ul.value].img+")");';
//        _html += "   smeta.rooms.room[0].categories[" + _param.number + "].material_scroll = ul.value;";
////                            _html +=     "var _item = $(this).parents('.item_material');" +
////                                        "o33 = priceProfil(0, "+_room_id+");" +
////                                        "if("+_material_id+">=33 && "+ _material_id +"<=38){" +
////                                            " Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, o33);" +
////                                        "}else {Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, 0);} ";
//        _html += "},";
//        _html += "stop : function (e, ul) {";
//        _html += "smeta.rooms.room[0].categories[" + _param.number + "].setMaterial(ul.value);";
//        _html += "smeta.calc.update();";
//                            _html += "var _item = $(this).parents('.item_material');  Ballon.stop(_item, "+_room_id+", "+_material_id+", ul.value); ";
//        _html += "},";
        _html += "});";
//                                _html += '$("#calc-material-'+_id_index+'").on("change", function() { Ballon.onEnabled('+_room_id+', '+_material_id+', this.checked, true) })';
        _html += '</script>';
        _html += '</'+(_parent.smetaId === null ? 'div' : 'li')+'>';
        $(".slider_img")
            .mouseenter(function() {
                $(this).children(".slider_about").show();
            })
            .mouseleave(function() {
                $(this).children(".slider_about").hide();
            });
        return   _html;
    };
    _this.updateEnable = function(){
        if (_parent.smetaId === null) {
            if ($.inArray(_parent.types.getCombination(), _repairRateCombination) !== -1){
                _this.setEnable(true);
            } else {
                _this.setEnable(false);
            }
        }
    };
    _this.setChildrenId = function($id){
        _childrenId = $id;
    };
    // иницилизация категории
    _this.init = function() {
         _this.updateEnable();
         
          // галочка у материалов
        $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').die('click');
        $('.material-enable[data-room-id="'+_room.getId()+'"][data-cat-id="'+_this.getId()+'"]').live('click', function() {
            $(this).toggleClass('ignore_4 ignored_4');
            _this.setEnable($(this).hasClass('ignore_4'));
            
            if(_this.getEnable()){
                _room.setMaterialsEnable(true, false);
            }
            _parent.update();
        });
        // изменение категории
       $('.selectbox[data-cat-id="'+_this.getId()+'"][data-room-id="'+_room.getId()+'"][data-room-type="' +_room.getType() + '"]').die('change');
       $('.selectbox[data-cat-id="'+_this.getId()+'"][data-room-id="'+_room.getId()+'"][data-room-type="' +_room.getType() + '"]').live('change', function(){
            _this.setChildrenId(Number($(this).val()));
            console.log('нужно загрузить другие материалы// или изменить');
            // тут изменение материалов
            //_parent.update(); // пересчитать смету и сохранить
       });
        // иницилизировать материалы (для категории и подкатегорий)
    };
    _this.init();
}