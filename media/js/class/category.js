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

   _this.materials = new Array();
   _this.material = null;
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
    // выбрать материал
    _this.setMaterial = function(){
        $.each(_this.materials, function(k, material) {
            if(material.getSelected()===1){
                if (_parent.smetaId === null) {
                    _this.material = material;
                }else if(_room.getId()==material.getRoomId()){
                    _this.material = material;
                }
            };
        });
    };
    // убрать выбранный материал
    _this.deleteSelectedMaterial = function(){
        $.each(_this.materials, function(k, material) {
            material.deleteSelected();
        });
    };
    // выбранный материал
    _this.getMaterial = function(){
        return _this.material;
    };
    //
    _this.getMaterials = function(){
        return _this.materials;
    };
    // параметры для сметы
    _this.getParams = function() {
        var params = {
            id: _this.getId(),
            enable: _this.getEnable(),
            material_id: _this.getMaterial().getId()
        };
        if (_childrenId !== null) {
            params['childrenId'] =  _childrenId;
        }
        return params;
    };

    // html категории
    _this.getHTML = function() {
        
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
//                if (_childrenId  === Number(cat.getId())){
//                    material = cat.getMaterial();
//                }
            });
            _html += '</select>';
        } else {
            _html += ' <div class="materials_room_option_menu"></div>';
        }

        _html += '<div class="materials_room_option_slider">';
        _html += '    <div class="slider-materials-' + _id_index + '" style="position: relative">';
        _html += '        <div class="ui-slider-handle ui-state-default ui-corner-all"><h6 class="slider_price price-materials-' + _id_index + '">' + _this.material.getPrice() + ' р</h6></div>';
        _html += '    </div>';
        _html += '    <div class="slider_img" style="background-image: url(/media/img/material/'+_this.material.getImg()+')">';
        _html += '    <div class="slider_about">';
        _html += '        <a href="/materials/view/'  + _this.material.getId()+'" target="_blank" class="mat-name-' + _id_index + '">'  + _this.material.getName()+'</a>';
        _html += '        <h6 class="city-name-' + _id_index + '">' + _this.material.getCountry()+'</h6>';
        _html += '    </div>';
        _html += '</div>';
        _html += '     <div class="x"></div>';
        _html += '     <h1>'+_this.material.count_material()+' '+_this.material.getCount_text_ready()+'  =</h1>';
        _html += '     <h2 class="mat-price-all-' + _id_index + '">'+_this.material.getAllPrice()+' р.</h2>';
        _html += '</div>';
        _html += '<script>';
        _html += "$('.slider-materials-" + _id_index + "').slider({";
            _html += "min: 0,";
            _html += "orientation : 'vertical',";
            _html += "value: " + (_parent.smetaId === null ? 10 : 5) + ",";
            _html += 'max: ' + 20 + ',';
            _html += "step: 1,";
            _html += "create: function () {},";
        _html += "slide: function (e, ul) { ";
        _html += '   $(".price-materials-' + _id_index + '").text(number_format(Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].getPrice(), \'2\', \',\', \' \') +\' р.\');';
        _html += '   $(".mat-price-all-' + _id_index + '").text(number_format(Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].getAllPrice(), \'2\', \',\', \' \') +\' р.\');';
        _html += '   $(".mat-name-' + _id_index + '").text(Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].getName());';
        _html += '   $(".city-name-' + _id_index + '").text(Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].getCountry());';
        _html += '   $("#materials-' + _id_index + '").find(".slider_img").css( "background-image","url(/media/img/material/"+Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].getImg()+")");';
       // _html += "   smeta.rooms.room[0].categories[" + _param.number + "].material_scroll = ul.value;";
//                            _html +=     "var _item = $(this).parents('.item_material');" +
//                                        "o33 = priceProfil(0, "+_room_id+");" +
//                                        "if("+_material_id+">=33 && "+ _material_id +"<=38){" +
//                                            " Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, o33);" +
//                                        "}else {Ballon.show(_item, "+_room_id+", "+_material_id+", ul.value, 0);} ";
        _html += "},";
        _html += "stop : function (e, ul) {";
        _html += 'Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].deleteSelectedMaterial();';
        _html += 'Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].materials[ul.value].setSelected();';
        _html += 'Smeta.rooms['+_room.getNumber()+'].categories[' + _params.number + '].setMaterial();';
        _html += "console.log('пересчитать смету(работы)');";
        //_html += "smeta.rooms.room[0].categories[" + _param.number + "].setMaterial(ul.value);";
        //_html += "smeta.calc.update();";
        // _html += "var _item = $(this).parents('.item_material');  Ballon.stop(_item, "+_room_id+", "+_material_id+", ul.value); ";
        _html += "},";
        _html += "});";
//                                _html += '$("#calc-material-'+_id_index+'").on("change", function() { Ballon.onEnabled('+_room_id+', '+_material_id+', this.checked, true) })';
        _html += '</script>';
        _html += '</'+(_parent.smetaId === null ? 'div' : 'li')+'>';
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
    // для selectbox
    _this.newCategory = function($id){
        _this.setChildrenId($id);
        _this.selectMaterials();
        _room.updateCategoriesHTML();
    };
    // выбрать материалы для категории
    _this.selectMaterials = function(){
        var _materials = new Array();
        $.each(Loaded.materials, function(key, material) {
            if(Number(material.category_id) === Number(_this.getId()) || Number(material.category_id) === Number(_childrenId)){
                _materials.push(new Material(_parent, _room, material));
            };
        });
        _this.materials = $.extend(true, [], _materials);
        _this.setMaterial();
    };
    // иницилизация категории
    _this.init = function() {
         _this.updateEnable();
      //  console.log(_params);
      //  // замысел хорош. но нужно продумать.
//        if (_childrens !== null) {
//            var cat_children = new Array();
//            $.each(_params.childrens, function (key, cat) {
//                cat_children.push(new Category(_parent, _room, cat));
//            });
//            _childrens = $.extend(true, [], cat_children);
//        };
//        var _materials = new Array();
//            $.each(Loaded.materials, function(key, material) {
//                if(Number(material.category_id) === Number(_this.getId()) || Number(material.category_id) === Number(_childrenId)){
//                    _materials.push(new Material(_parent, _room, material));
//                };
//            });
//            _this.materials = $.extend(true, [], _materials);
////        _materials = $.extend(true, [], cat_materials);
//        _this.setMaterial();
        _this.selectMaterials();
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
            // при изменении чилдрен - изменить переменую _this.materials - новыми материалами
            // тут изменение материалов
            //_parent.update(); // пересчитать смету и сохранить
       });
        // иницилизировать материалы (для категории и подкатегорий)
    };
    _this.init();
}