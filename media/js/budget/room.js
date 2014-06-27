/**
 * Room
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {array} $elements
 * @param {array} $params
 */
function Room($parent, $elements, $params)
{
    var _this = this;
    var _parent = $parent;
    var _max_windows_in_room = 2;

    var _elements = {
        Title: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #cacl-" + $elements.type + "-title",
        Length: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #calc-" + $elements.type + "-length",
        Width: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #calc-" + $elements.type + "-width",
        Size: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #cacl-" + $elements.type + "-size",
        Balcon: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #calc-" + $elements.type + "-balcon",
        Enable: ".smeta_room[data-" + $elements.type + "='" + $params.id + "'] #calc-" + $elements.type + "-enable"
    };
    var _params = $params || {};
    var _titles_windows = {
        1: {1: 'Окно в комнате №1', 2: 'Окно в комнате №2', 3: 'Окно в комнате №3', 4: 'Окно в комнате №4', 5: 'Окно в комнате №5'},
        2: {1: 'Окно на кухне'},
        3: {},
        4: {},
        5: {}
    };
    var _titles_doors = {
        1: {1: 'Дверь межкомнатная'},
        2: {},
        3: {1: 'Входная дверь'},
        4: {},
        5: {}
    };

    if (_params.balcon) {
        _this.balcon = _params.balcon;
    }
    if (_params.door) {
        _this.door = _params.door;
    }else{
        _this.door = 0;
    }
    if (_params.window) {
        _this.window = _params.window;
    }

    _this.id = _params.id;
    _this.type = _params.type;
    _this.title = _params.title;
    _this.width = _params.width;
    _this.length = _params.length;
    _this.enable = _params.enable || false;
    _this.show = _params.show || true;
    _this.work_dem = [];
    _this.work_mon = [];
    _this.categories = [];
    _this.categories_enable = _this.enable;
    _this.work_dem_enable = _this.enable;
    _this.work_mon_enable = _this.enable;

    /**
     * 
     * @returns {Number|_params.door}
     */
    _this.getDoor = function(){
        if(_this.door === 0){            
            return _this.door;
        }else{
            return _this.door[0].getCount();
            
        }
    };
    _this.getSizeWindows = function(){
        var size = 0;
        if(_this.window === undefined){
            return size;
        }
        for(var win in _this.window){
            size += Number(_this.window[win].getSize());
        }
        return size;
    },

    _this.getSize = function() {
        return Number(_this.getWidth() * _this.getLength()).toFixed(2);
    },
    _this.getPerimeter = function() {
        return (Number(_this.getWidth()) + Number(_this.getLength())) * 2;
    },
    _this.getPerimeterWall = function (){
        var height = _parent.calcRoomHeight.getHeight();
        var _perimeter = 0;
        if (in_array(_this.getType(), [1, 2])) {
            _perimeter = Number(_this.getPerimeter()) * Number(height) - Number(_this.getSizeWindows()) - Number(_this.door === 0 ?0:_this.door[0].getSize()) - Number( _this.getBalcon() ? 1.6 : 0);
        } else if (_this.getType() === 3) {
            _perimeter = Number(_this.getPerimeter()) * Number(height) -  Number(_this.door === 0 ?0:_this.door[0].getSize());
        } else {
            _perimeter = Number(_this.getPerimeter()) * Number(height) -  Number(_this.door === 0 ?0:_this.door[0].getSize());
        }
        return _perimeter;
    };
    _this.getEnable = function() {
        return _this.enable;
    };
    _this.setEnable = function($enable) {
        var _i;
        _this.enable = $enable;
        _this.show = true;
        if ($enable) {
            $(_elements.Enable).removeClass('ignored').addClass('ignore').attr('data-enable', $enable);
        } else {
            $(_elements.Enable).removeClass('ignore').addClass('ignored').attr('data-enable', $enable);
        }
        _this.categories_enable = $enable;
        _this.work_dem_enable = $enable;
        _this.work_mon_enable = $enable;
        // Включить и отключить материалы
        for (_i in _this.categories) {
            _this.categories[_i].enable = $enable;
            _this.updateCategories();
        }
        for (_i in _this.work_dem) {
            _this.work_dem[_i].enable = $enable;
        }
        for (_i in _this.work_mon) {
            _this.work_mon[_i].enable = $enable;
        }

        if (_this.door)
            _this.updateDoor();
        if (_this.window)
            _this.updateWindow();
    };

    _this.getBalcon = function() {
        return _this.balcon;
    };
    _this.setBalcon = function($type) {
        return _this.balcon = $type;
    };
    _this.getTitle = function() {
        return _this.title;
    };
    _this.setTitle = function(title) {
        _this.title = title;
        if (_elements.Title !== undefined) {
            $(_elements.Title).html(_this.title);
        }
    };
    _this.getType = function() {
        return _this.type;
    };
    _this.setType = function($type) {
        return _this.type = $type;
    };
    _this.getId = function() {
        return _this.id;
    };
    _this.getWidth = function() {
        return  _this.width;
    };
    _this.setWidth = function($width) {
        _this.width = $width;
    };
    _this.getLength = function() {
        return _this.length;
    };
    _this.setLength = function($length) {
        _this.length = $length;
    };
    _this.updateDoor = function() {
        if (_this.door.length > 0) {
            var door;
            for (door in _this.door) {
                _this.door[door].setEnable(_this.getEnable());
                _this.door[door].update();
            }
        }
    };
    _this.updateWindow = function() {
        if (_this.window.length > 0) {
            var win;
            for (win in _this.window) {
                _this.window[win].setEnable(_this.getEnable());
                _this.window[win].update();
            }
        }
    };
    _this.updateCategories = function() {
        for (var cat in _this.categories) {
            _this.categories[cat].setEnable(_this.getEnable());
            _this.categories[cat].update();
        }
    };
    _this.addDoor = function() {
        if ((_this.type === 1 && _this.id === 1) || _this.type === 3) {
            if (_max_windows_in_room < _this.door.length) {
                alert('Максимальное число дверей ' + _max_windows_in_room);
                return true;
            }

            var _elements_w = {
                Id: _this.door.length + 1,
                id_room: _this.id,
                type_room: _this.type,
                type: "door"
            };
            var _params_w = {
                width: 0.80,
                length: 2.00,
                title: _titles_doors[_this.type][_this.id],
                enable: _this.getEnable(),
                count: 4
            };
            if (_this.type === 3) {
                _params_w.width = 0.9;
            }
            _this.door.push(new Door(_parent, _elements_w, _params_w));

            if (_this.type === 1 && _this.id === 1) {
                for (var door = 2; door <= 3; door++) {
                    _elements_w = {
                        Id: door,
                        id_room: _this.id,
                        type_room: _this.type,
                        type: "door"
                    };

                    _params_w = {
                        width: 0.80,
                        length: 2.00,
                        title: _titles_doors[_this.type][_this.id],
                        enable: _this.getEnable(),
                        show: false
                    };
                    _this.door.push(new Door(_parent, _elements_w, _params_w));
                }
            }
        } else {
            alert('Нельзя в  ' + _this.title + ' добавить дверь');
        }
    };
    _this.addWindow = function() {
        if (!_this.window) {
            alert('В ' + _this.title + ' нельзя добавить окно');
            return false;
        }
        if (_max_windows_in_room < _this.window.length) {
            alert('Максимальное число окон ' + _max_windows_in_room);
            return true;
        }
        if (_this.type === 2) {
            $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore('#add_window').attr('data-window', _this.id).attr('data-type-room', _this.type);
        }
        if (_this.window.length === 0 || (_this.getType() === 1 && _this.getId() === 1)) {
            var _elements_w = {
                Id: _this.window.length + 1,
                id_room: _this.id,
                type_room: _this.type,
                type: "window"
            };

            var _params_w = {
                id: _this.window.length +1,
                width: 1.30,
                length: 1.40,
                title: _titles_windows[_this.getType()][_this.getId()],
                enable: _this.getEnable(),
                type_id: 3
            };
            _this.window.push(new Windows(_parent, _elements_w, _params_w));

//            if (_this.window.length > 1 && _parent.categories.length > 0) {
//                _this.categories.push(new RoomsCategories(_parent, 29, _this, {name: 'Окно №' + _this.window.length, chaild: 46}));// окно              
//            }
        } else {
            alert('Окно уже добавлено в ' + _this.title);
        }
    };
    _this.initCategories = function()
    {
        if (_parent.load.status === false) {
            alert('Категории еще не подгрузились, кликните еще раз');
            return false;
        }
        _this.categories = [];
        _this.work_dem = [];
        _this.work_mon = [];
        var _i;
        if (_this.type === 1) {
            _this.categories[1] = new RoomsCategories(_parent, 11, _this, {number: 1, chaild: 33});// Обои 11
            _this.categories[2] = new RoomsCategories(_parent, 27, _this, {number: 2});// Потолок
            _this.categories[3] = new RoomsCategories(_parent, 28, _this, {number: 3, chaild: 39});// Пол 28
            if (_parent.calcRemontEBP.getEBPId() !== 1)
                _this.categories[4] = new RoomsCategories(_parent, 18, _this, {number: 4});// Кондиционер
            _this.categories[5] = new RoomsCategories(_parent, 19, _this, {number: 5});	// Отопление
            for (_i in _this.window) {
                var cat = {1: 46, 2: 47, 3: 48};
                _this.categories[Number(_i) + 6] = new RoomsCategories(_parent, 29, _this, {number: Number(_i) + 6, name: 'Окно №' + (Number(_i) + 1), chaild: cat[_parent.calcRemontEBP.getEBPId()]});// окно     29    
            }

        } else if (_this.type === 2) {
            if (_parent.calcRemontEBP.getEBPId() === 1)
                _this.categories[1] = new RoomsCategories(_parent, 11, _this, {number: 1, chaild: 33});	// Обои
            _this.categories[2] = new RoomsCategories(_parent, 27, _this, {number: 2});	// Потолок
            _this.categories[3] = new RoomsCategories(_parent, 28, _this, {number: 3, chaild: 39});// Пол
            _this.categories[4] = new RoomsCategories(_parent, 45, _this, {number: 4});// Рукав
            _this.categories[5] = new RoomsCategories(_parent, 19, _this, {number: 5});	// Отопление
            if (_parent.calcRemontEBP.getEBPId() !== 1){
                _this.categories[6] = new RoomsCategories(_parent, 18, _this, {number: 6});// Кондиционер
            }else{
                
            }
            var cat = {1: 46, 2: 47, 3: 48};
            _this.categories[7] = new RoomsCategories(_parent, 29, _this, {number: Number(_i) + 6, name: 'Окно на кухне' , chaild: cat[_parent.calcRemontEBP.getEBPId()]});// окно     29    
        } else if (_this.type === 3) {
            _this.categories[1] = new RoomsCategories(_parent, 11, _this, {number: 1, chaild: 33});	// Обои
            _this.categories[2] = new RoomsCategories(_parent, 27, _this, {number: 2});	// Потолок
            _this.categories[3] = new RoomsCategories(_parent, 28, _this, {number: 3, chaild: 39});// Пол
        } else if (_this.type === 4) {
             _this.categories[1] = new RoomsCategories(_parent, 12, _this, {number: 1});// Краска
             _this.categories[2] = new RoomsCategories(_parent, 13, _this, {number: 2});// Ванна
             _this.categories[3] = new RoomsCategories(_parent, 15, _this, {number: 3});// умывальник
             _this.categories[4] = new RoomsCategories(_parent, 16, _this, {number: 4});// Смеситель
             _this.categories[5] = new RoomsCategories(_parent, 17, _this, {number: 5});// Полотенцесушитель
             _this.categories[6] = new RoomsCategories(_parent, 28, _this, {number: 6, chaild: 44});// Пол
             _this.categories[7] = new RoomsCategories(_parent, 30, _this, {number: 7}); // Для раковины
             _this.categories[8] = new RoomsCategories(_parent, 11, _this, {number: 8, chaild: 38}); // Обои
             _this.categories[9] = new RoomsCategories(_parent, 27, _this, {number: 9}); // Потолок
                if(_this.getTitle() === 'ванна и туалет')_this.categories[10] = new RoomsCategories(_parent, 14, _this, {number: 10}); // Унитаз
        } else if (_this.type === 5) {
            _this.categories[1] = new RoomsCategories(_parent, 11, _this, {number: 1, chaild: 33});	// Обои
            _this.categories[2] = new RoomsCategories(_parent, 28, _this, {number: 2, chaild: 39});// Пол
            _this.categories[3] = new RoomsCategories(_parent, 14, _this, {number: 3}); // Унитаз
            _this.categories[4] = new RoomsCategories(_parent, 27, _this, {number: 4});	// Потолок
        }
    };


//    _this.getCountDoor = function() {
//        return door;
//    };
//    _this.getCountWindow = function() {
//        return window;
//    };

    _this.onEnable = function() {
        if (_this.getType === 1 && !_this.getEnable())
            _parent.setupRoomLis.addCountRoom();
        _this.setEnable(true);
    };
    _this.onChangeWidth = function() {
        _this.onEnable();
        _this.setWidth(Number(new String($(this).val()).replace(/\,/, ".")).toFixed(2));
        _this.update();
//        _this.onChangeEnable();
    };

    _this.onChangeLength = function() {
        _this.onEnable();
        _this.setLength(Number(new String($(this).val()).replace(/\,/, ".")).toFixed(2));
        _this.update();
//        _this.onChangeEnable();
    };


    _this.onChangeBalcon = function() {
        $(this).toggleClass("check_box_out check_box_in");
        _this.setBalcon($(this).hasClass('check_box_in'));
        if (_this.getBalcon()) {
            _this.onEnable();
        }
        $(this).attr('data-enable', _this.getBalcon());
//        _parent.calcRemontMaterials.update();
        return _this.update();
    };

    // вкл откл комнат
    _this.checkEnable = function() {
        _this.setEnable($(_elements.Enable).hasClass('ignore'));
        if (_this.getEnable()) {
            if (_this.getType() === 1)
                _parent.setupRoomLis.addCountRoom();
        }
    };
    _this.onChangeEnable = function() {
        var _i, _dem, _mon;
        $(this).toggleClass("ignore ignored");
        _this.setEnable($(this).hasClass('ignore'));
        if (_this.getType() === 1) {
            if (_this.getEnable()) {
                _parent.setupRoomList.addCountRoom();
            } else {
                _parent.setupRoomList.delCountRoom();
            }
        }


//            smeta.setupRoomLis.changeRoom();
        // обновление количества номнат
//        smeta.setupRoomLis.update();
//        var room_title = ' ';
//        for (var i in _parent.rooms.room) {
//            if (_parent.rooms.room[i].enable() && $.inArray(_parent.rooms.room[i].getType(), [1, 2, 3, 4, 5]) != -1)
//                room_title += _parent.rooms.room[i].getTitle() + ' ';
//        }
//        $('.work_room').html(room_title);

//        _parent.setupRoomLis.updateCountRoom();
////            _parent.setupRoomLis.update();
//        _parent.calcRemontMaterials.update();
        for (_i in _this.categories) {
            _this.categories[_i].enable = _this.enable;
        }
        for (_dem in _this.work_dem) {
            if (_this.work_dem.length > 0) {
                _this.work_dem[_dem].setEnable(_this.enable);
            }
        }
        for (_mon in _this.work_mon) {
            if (_this.work_mon.length > 0) {
                _this.work_mon[_mon].setEnable(_this.enable);
            }
        }
        _this.update();
    };

    /**
     * 
     * @returns {String}
     */
    _this.getGroups = function()
    {
        var _content = '';
        if (_parent.getInitCategory() === true){
            _this.initCategories();
            if(_this.type === 5){
                _parent.setInitCategory(false);                
            }
        }
        
        if (_this.show === true) {
            var _i;
            _content = '<div class="budget_basic_options_name_materials style1">';
            _content += '<div class="slide1 budget_basic_options_name_style1_down" data-type="' + _this.type + '" data-id="' + _this.id + '">';
            _content += '<p class="budget_basic_options_name_materials_header" id="toggle_room">' + _this.title + '</p>';
            _content += '<div class="ignore' + (_this.categories_enable ? '' : 'd') + '_4 on-off-categories"  data-type="' + _this.type + '" data-id="' + _this.id + '"></div>';
            _content += '</div>';
            _content += '<div class="materials_room_for_options"  data-type="1" data-id="1">';

            for (_i in _this.categories)
            {
                _content += _this.categories[_i].updateHTML();
            }
            _content += '</div>';
            _content += '</div>';
        }else{
            for (_i in _this.categories)
            {
                _this.categories[_i].updateCountMaterial();
            }
        }
        return _content;
    };
    _this.update = function()
    {
        if (_elements.Length !== undefined) {
            $(_elements.Length).val(new String(_this.getLength()).replace(/\./, ","));
        }
        if (_elements.Width !== undefined) {
            $(_elements.Width).val(new String(_this.getWidth()).replace(/\./, ","));
        }
        if (_elements.Size !== undefined) {
            $(_elements.Size).html(new String(_this.getSize()).replace(/\./, ","));
        }
        if (_elements.Title !== undefined) {
            $(_elements.Title).html(_this.getTitle());
        }
        if (_elements.Balcon !== undefined) {
            $(_elements.Balcon).data('enable', _this.getBalcon());
        }
        if (_elements.Enable !== undefined) {
            $(_elements.Enable).removeClass('ignored, ignore').addClass('ignore' + (_this.getEnable() ? '' : 'd')).attr('data-enable', _this.getEnable());
        }

//        if (_parent.load.status === true) {
//            _parent.setupRoomList.updateMaterials();
//        }

        if (_this.door) {
            _this.updateDoor();
        }
        if (_this.window) {
            _this.updateWindow();
        }

//        _parent.calcRoomSize.update();// обновить цены
    };
    _this.init = function()
    {
//        _this.checkEnable();
        if (_elements.Width !== undefined) {
            $(document).on('change', _elements.Width, _this.onChangeWidth);
        }
        if (_elements.Length !== undefined) {
            $(document).on('change', _elements.Length, _this.onChangeLength);
        }
        if (_elements.Balcon !== undefined) {
            $(document).on('click', _elements.Balcon, _this.onChangeBalcon);
        }
        if (_elements.Enable !== undefined) {
            $(document).on('click', _elements.Enable, _this.onChangeEnable);
        }

        if (_this.window) {
            _this.addWindow();
        }
        if (_this.door) {
            _this.addDoor();
        }

        _this.update();

    };
    _this.init();
}

/*
 * Ванная, туалет
 */
//function Bath($parent, $elements, $params)
//{
//    var _parent = $parent;
//    var _this = this;
//    var _params = $params;
//     var _elements = {
//            Title	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #cacl-"+$elements.type+"-title",
//            Length	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #calc-"+$elements.type+"-length",
//            Width	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #calc-"+$elements.type+"-width",
//            Size	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #cacl-"+$elements.type+"-size",
//            Balcon	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #calc-"+$elements.type+"-balcon",
//            Enable	: ".smeta_room[data-"+$elements.type+"='"+$params.id+"'] #calc-"+$elements.type+"-enable"
//    };
//
//    var _id = _params.Id;
//    _this.title = _params.title;
//    _this.width = _params.width;
//    _this.length = _params.length;
//    var _this.type = _params.type;
//    _this.enable = _params.enable;
//    var _door_in_room = _params.window;
//    var _window_in_room = _params.window;
////    var tupes = {4: "bath", 5: "toilet"};
//
//    _this.getSize = function() {
//        return ( _this.width * _this.length).toFixed(2);
//    };
//    _this.getPerimeter = function() {
//        return ( _this.width + _this.length) * 2;
//    };
//    _this.getWidth = function() {
//        return  _this.width;
//    };
//    _this.setWidth = function($width) {
//         _this.width = $width;
//    };
//    _this.getLength = function() {
//        return _this.length;
//    };
//    _this.setLength = function($length) {
//        _this.length = $length;
//    };
//    _this.getDoor = function() {
//        return _door_in_room;
//    };
//    _this.getWindow = function() {
//        return _window_in_room;
//    };
//    _this.enable = function() {
//        return _this.enable;
//    };
//    _this.setEnable = function($enable) {
//        enable = $enable;
//        $(_elements.Enable).attr('data-enable', enable);
//    };
//    _this.is_room = function() {
//        return true;
//    };
//    _this.getTitle = function() {
//        return title;
//    };
//    _this.setTitle = function($title) {
//        title = $title;
//        $(_elements.Title).html(title);
//    };
//    _this.getType = function() {
//        return type;
//    };
//    _this.getId = function() {
//        return id;
//    };
//
//    _this.init = function()
//    {
//        if (_elements.Length != undefined) {   $(document).on('change', _elements.Length, _this.onChangeLength);     }
//
//        if (_elements.Width != undefined) {     $(document).on('change', _elements.Width, _this.onChangeWidth);       }
//
//        if (_elements.Enable != undefined) {        $(document).on('change', _elements.Enable, _this.onChangeEnable);      }
//
//        _this.update();
//    };
//
//    _this.onChangeWidth = function() {
//        console.log('Поставить галочку в ванной,  туалете');
////        $(_elements.Enable).attr('checked', 'checked');
//        width = Number($(this).val().replace(/\,/, "."));
//        _this.onChangeEnable();
//    };
//
//    _this.onChangeLength = function() {
//        console.log('Поставить галочку в ванной,  туалете');
////        $(_elements.Enable).attr('checked', 'checked');
//        length = Number($(this).val().replace(/\,/, "."));
//        _this.onChangeEnable();
//    };
//
//    _this.onChangeEnable = function() {
//        console.log('Посчитать смету посчитать материалы');
////        enable = $(_elements.Enable).is(':checked');
////        var room_title = ' ';
////        for (var i in _parent.rooms.room) {
////            if (_parent.rooms.room[i].enable() && $.inArray(_parent.rooms.room[i].getType(), [1, 2, 3, 4, 5]) != -1)
////                room_title += _parent.rooms.room[i].getTitle() + ' ';
////        }
////        $('.work_room').html(room_title);
//        _this.update();
////        _parent.calcRemontMaterials.update();
//    };
//
//    _this.update = function() {
//
//
//        if (_elements.Title != undefined) {     $(_elements.Title).html(title);       }
//        if (_elements.Length != undefined) { $(_elements.Length).val(length.toFixed(2).replace(/\./, ","));     }
//        if (_elements.Width != undefined) {  $(_elements.Width).val(width.toFixed(2).replace(/\./, ","));      }
//        if (_elements.Size != undefined) {      $(_elements.Size).text(_this.getSize());   }
//
//        if (_elements.Enable != undefined) {
//            $(_elements.Enable)[enable ? 'attr' : 'removeAttr']('checked', 'checked');
//            if (_parent.rooms.room[7])
//                _parent.rooms.room[7].count = function() {
//                    _parent.calcRoomSize.getCountRoom([3]);
//                }
//            $('#calc-room-count-6').text(_parent.calcRoomSize.getCountRoom([1, 2]));
//            $('#calc-room-count-8').text(_parent.calcRoomSize.getCountRoom([1, 2, 4, 5]));
//
//        }
//
//        _parent.calcRoomSize.update();
//    };
//
//    _this.getMaterials = function()
//    {
//        return "<b>room line 83</b>";
//    };
//
//    /**
//     * Return all materials to curent selected type
//     */
//    _this.materials = function()
//    {
//        var _materials = [];
//
//        if (_this.type() == 4)
//        {
//            _materials[1] = new RoomsMaterials(_parent, 16, _this);	// Краска
//            _materials[2] = new RoomsMaterials(_parent, 17, _this);	// Ванная/Кабина
//            _materials[3] = new RoomsMaterials(_parent, 19, _this);	// Умывальник
//            _materials[4] = new RoomsMaterials(_parent, 20, _this);	// Смеситель
//            _materials[5] = new RoomsMaterials(_parent, 21, _this);	// Полотенцесушитель
//            _materials[6] = new RoomsMaterials(_parent, 32, _this);// Пол
//            _materials[7] = new RoomsMaterials(_parent, 40, _this);// Для раковины
//            _materials[8] = new RoomsMaterials(_parent, 13, _this);	// Обои
//            _materials[9] = new RoomsMaterials(_parent, 31, _this);	// Потолок
//            if ($('#calc-marge-rooms').hasClass("refuse"))
//                _materials[10] = new RoomsMaterials(_parent, 18, _this);	// Унитаз
//            //_materials[8] = new RoomsMaterials(_parent, 3 , _this);	// Плитка
//        }
//        else if (_this.type() == 5)
//        {
//            _materials[1] = new RoomsMaterials(_parent, 13, _this);	// Обои
//            _materials[2] = new RoomsMaterials(_parent, 32, _this);// Пол
//            _materials[3] = new RoomsMaterials(_parent, 18, _this);	// Унитаз
//            _materials[9] = new RoomsMaterials(_parent, 31, _this);	// Потолок
//            //_materials[1] = new RoomsMaterials(_parent, 3 , _this);	// Плитка
//        }
//
//        return _materials;
//    };
//
//    /**
//     * Return all material's group contets(html)
//     *
//     */
//    _this.getGroups = function()
//    {
//        var _materials = _this.materials();
//        var _i;
//        var hide_mater = '';
//        if (_parent.calcRemontMaterials.get_count_materials_show() > 2)
//            hide_mater = ' class="hide_mater"';
//        var _content = "<div><div" + hide_mater + "><center class=\"title\">" + _this.getTitle() + "</center></div>";
//
//        for (_i in _materials) {
//            _content += _materials[_i].update();
//        }
//
//        return _content + "</div>";
//    };
//
//    _this.init();
//
//}




/**
 * Другие материалы
 *
 */
//function Other($parent, $elements, $title, $type, $params)
//{
//    var _parent = $parent;
//    var _this = this;
//    var id = -1;
//    var elements = $elements || {};
//    var title = '<span>' + $title + '</span>' || '<span>Комната</span>';
//    var width = 4.5;
//    var length = 4;
//    var size = width * length;
//    var perimeter = (width + length) * 2;
//    var enable = true;
//    // Have balcon
//    var balcon = false;
//    // Комната 1, Нужно для демонтажних работ
//    var type = 1;
//    // All type, what support this object
//    var types = {
//        1: "room",
//        2: "kitchen",
//        3: "corridor"
//    };
//
//    /**
//     * Return all materials to curent selected type
//     */
//    _this.materials = function()
//    {
//        var _materials = [];
////			_materials.push( new RoomsMaterials(_parent, 32, _this) );  // Пол
//        _materials.push(new RoomsMaterials(_parent, 1, _this));  // Плинтус
//        _materials.push(new RoomsMaterials(_parent, 2, _this));  // Порог
//        if ($('#calc-room-enable-7').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 5, _this));  // Дверь входная
//        if ($('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 6, _this));  // Дверь межкомнатная
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 7, _this));  // Дверные ручки
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 8, _this));  // Замки
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 9, _this));  // Защёлки
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 10, _this));  // Накладки дверные
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 11, _this));  // Петли
//        if ($('#calc-room-enable-7').prop("checked") || $('#calc-room-enable-8').prop("checked"))
//            _materials.push(new RoomsMaterials(_parent, 12, _this));  // Цилиндры
//        _materials.push(new RoomsMaterials(_parent, 15, _this));  // Краска
////			_materials.push( new RoomsMaterials(_parent, 17, _this) );  // Ванная/Кабина
////			_materials.push( new RoomsMaterials(_parent, 18, _this) );  // Унитаз
////			_materials.push( new RoomsMaterials(_parent, 19, _this) );  // Умывальник
////			_materials.push( new RoomsMaterials(_parent, 20, _this) );  // Смеситель
////			_materials.push( new RoomsMaterials(_parent, 21, _this) );  // Полотенцесушитель
////			_materials.push( new RoomsMaterials(_parent, 23, _this) );  // Отопление
//        _materials.push(new RoomsMaterials(_parent, 24, _this));  // Клей для плитки
//        _materials.push(new RoomsMaterials(_parent, 25, _this));  // Затирка
//        _materials.push(new RoomsMaterials(_parent, 26, _this));  // Клей для обоев
//        _materials.push(new RoomsMaterials(_parent, 27, _this));  // Подложка
//        _materials.push(new RoomsMaterials(_parent, 28, _this));  // Клей для пола
//        _materials.push(new RoomsMaterials(_parent, 29, _this));  // Лак для пола
//        _materials.push(new RoomsMaterials(_parent, 30, _this));  // Клея для линолеума
//        var rom = new CalcRoomSize(_parent).getCountRoom([1, 2]);
//
//        if (Number($('#calc-room-count-6').text()) > Number(rom)) {
//            if (_parent.calcRoomSize.getLengthRoom([6]) >= 0.9 && _parent.calcRoomSize.getLengthRoom([6]) <= 1.6 && _parent.calcRoomSize.getWidthRoom([6]) >= 0.4 && _parent.calcRoomSize.getWidthRoom([6]) <= 1.0) {
//                _materials[4] = new RoomsMaterials(_parent, 33, _this);
//            }
//            if (_parent.calcRoomSize.getLengthRoom([6]) > 1.6 && _parent.calcRoomSize.getLengthRoom([6]) <= 2.3 && _parent.calcRoomSize.getWidthRoom([6]) >= 0.4 && _parent.calcRoomSize.getWidthRoom([6]) <= 1.0) {
//                _materials[5] = new RoomsMaterials(_parent, 34, _this);
//            }
//            if (_parent.calcRoomSize.getLengthRoom([6]) >= 0.9 && _parent.calcRoomSize.getLengthRoom([6]) <= 1.6 && _parent.calcRoomSize.getWidthRoom([6]) > 1 && _parent.calcRoomSize.getWidthRoom([6]) <= 1.7) {
//                _materials[6] = new RoomsMaterials(_parent, 35, _this);
//            }
//            if (_parent.calcRoomSize.getLengthRoom([6]) > 1.6 && _parent.calcRoomSize.getLengthRoom([6]) <= 2.3 && _parent.calcRoomSize.getWidthRoom([6]) > 1 && _parent.calcRoomSize.getWidthRoom([6]) <= 1.7) {
//                _materials[7] = new RoomsMaterials(_parent, 36, _this);
//            }
//            if (_parent.calcRoomSize.getLengthRoom([6]) >= 0.9 && _parent.calcRoomSize.getLengthRoom([6]) <= 1.6 && _parent.calcRoomSize.getWidthRoom([6]) > 1.7 && _parent.calcRoomSize.getWidthRoom([6]) <= 2.7) {
//                _materials[8] = new RoomsMaterials(_parent, 37, _this);
//            }
//            if (_parent.calcRoomSize.getLengthRoom([6]) > 1.6 && _parent.calcRoomSize.getLengthRoom([6]) <= 2.3 && _parent.calcRoomSize.getWidthRoom([6]) > 1.7 && _parent.calcRoomSize.getWidthRoom([6]) <= 2.7) {
//                _materials[9] = new RoomsMaterials(_parent, 38, _this);
//            }
//        }
//
//        return _materials;
//    };
//
//    _this.getSize = function() {
//        return width * length;
//    };
//    _this.getPerimeter = function() {
//        return (Number(width) + Number(length)) * 2;
//    };
//    _this.enable = function() {
//        return enable;
//    };
//    _this.setEnable = function($enable)
//    {
//        enable = $enable;
//        if (elements.Enable != undefined)
//        {
//            $(elements.Enable)[enable ? 'attr' : 'removeAttr']('checked', 'checked');
//        }
////                if(enable)
////		_parent.calcRemontMaterials.update();
//    };
//    _this.balcon = function() {
//        return balcon;
//    };
//    _this.is_room = function() {
//        return true;
//    };
//    _this.is_flat = function() {
//        return true;
//    };
//    _this.getTitle = function() {
//        return title;
//    };
//    _this.setTitle = function($title) {
//        title = '<span>' + $title + '</span>';
//        if (elements.Title != undefined) {
//            $(elements.Title).html(title);
//        }
//    };
//    /*
//     * _this.type - old function, use getType
//     */
//    _this.type = function() {
//        return type;
//    };
//    _this.getType = function() {
//        return type;
//    };
//    _this.setType = function($type) {
//        type = $type;
//    };
//    _this.getId = function() {
//        return id
//    };
//    _this.getWidth = function() {
//        return width
//    };
//    _this.setWidth = function($width) {
//        width = $width
//    };
//    _this.getLength = function() {
//        return length
//    };
//    _this.setLength = function($length) {
//        length = $length
//    };
//
//
//
//    _this.init = function()
//    {
//        if (elements.Id != undefined)
//        {
//            id = elements.Id;
//        }
//
//        if (elements.Length != undefined)
//        {
//            $(document).on('change', elements.Length, _this.onChangeLength);
//        }
//
//        if (elements.Width != undefined)
//        {
//            $(document).on('change', elements.Width, _this.onChangeWidth);
//        }
//
//        if (elements.Balcon != undefined)
//        {
//            $(document).on('change', elements.Balcon, _this.onChangeBalcon);
//        }
//
//        if (elements.Enable != undefined)
//        {
//            $(document).on('change', elements.Enable, _this.onChangeEnable);
//        }
//
//        if ($type != undefined)
//            type = $type;
//
//        // Set params
//        $params = $.extend($params, {});
//
//        if ($params.width != undefined)
//        {
//            width = $params.width;
//        }
//
//        if ($params.leng != undefined)
//        {
//            length = $params.leng;
//        }
//
//        _this.update();
//    };
//
//
//    _this.onChangeWidth = function() {
//        width = $(this).val().replace(/\,/, ".");
//        _this.update();
//    };
//
//    _this.onChangeLength = function() {
//        length = $(this).val().replace(/\,/, ".");
//        _this.update();
//        return true;
//    };
//
//    _this.onChangeBalcon = function() {
//        balcon = $(this).is(':checked');
//        return _this.update();
//    };
//
//    _this.onChangeEnable = function() {
//        enable = $(this).is(':checked');
//        _this.update();
//        _parent.setupRoomList.update();
//    };
//
//    _this.update = function()
//    {
//        if (elements.Size != undefined)
//        {
//            $(elements.Size).val(_this.getSize());
//        }
//
//        if (elements.Title != undefined)
//            $(elements.Title).html(title);
//
//        if (elements.Length != undefined)
//        {
//            $(elements.Length).val(length);
//        }
//
//        if (elements.Width != undefined)
//        {
//            $(elements.Width).val(width);
//        }
//
//        if (elements.Balcon != undefined)
//        {
//            $(elements.Balcon)[balcon ? 'attr' : 'removeAttr']('checked', 'checked');
//        }
//
//        if (elements.Enable != undefined)
//        {
//            $(elements.Enable)[enable ? 'attr' : 'removeAttr']('checked', 'checked');
//        }
//
////		_parent.calcRoomSize.update();
//    };
//
//    /**
//     *1 указали сколько комнат 1-5
//     *
//     */
//    _this.getGroups = function()
//    {
//        var _materials = _this.materials();
//        var _i;
//        var hide_mater = '';
//        if (_parent.setupRoomList.get_count_materials_show() > 2)
//            hide_mater = ' class="hide_mater"';
//        var _content = "<div><div" + hide_mater + "><center class=\"title\">" + _this.getTitle() + "</center></div>";
//
//        for (_i in _materials)
//        {
//            _content += _materials[_i].updateHTML();
//        }
//
//        return _content + "</div>";
//    };
//
//    _this.init();
//}
