/**
 * @param {array} $parent
 * 
 * @returns {undefined}
 */
//function Window($parent) {
//
//    var _parent = $parent;
//    var _this = this;
//
//    _this.updatePrice = function() {
//        var _room, _cat;
//        for (_room in _parent.rooms.room) {
//            if (_parent.rooms.room[_room].categories[46] !== undefined) {
//                _parent.rooms.room[_room].categories[_cat].updatePrice();
//            }
//            if (_parent.rooms.room[_room].categories[47] !== undefined) {
//                _parent.rooms.room[_room].categories[_cat].updatePrice();
//            }
//            if (_parent.rooms.room[_room].categories[48] !== undefined) {
//                _parent.rooms.room[_room].categories[_cat].updatePrice();
//            }
//        }
//    },
//    _this.onLoad = function()
//    {
//        var _data = {
//            'width': 0,
//            'heidht': 0,
//            'countflap': 0
//        };
//        var _callbk = function() {
//
//        };
//        $.post('/ajax/getwindows', _data, _callbk, "json");
//    },
//    _this.init = function()
//    {
//        $("#add_window").on("click", function() {
//            if ($('#add_window').parent().children('.smeta_window[data-type-room="1"][data-id-room="1"]').length < 3) {
//                var count = _parent.rooms.room[0].window.length;
//                $('#add_window').parent().children('.smeta_window').eq(0).clone(true).insertBefore($('#add_window').parent().children('.smeta_window[data-window]').eq($('#add_window').parent().children('.smeta_window[data-type-room="1"][data-id-room="1"]').length === 1 ? 1 : 2)).attr('data-window', count + 1).attr('data-id-room', 1);
//                _parent.rooms.room[0].addWindow();
//                _parent.rooms.room[0].window[count].count = 1;
//                _parent.rooms.room[0].window[count].update();
//                _parent.setupRoomList.update();
//            }
//        });
//    };
//
//    _this.update = function() {
//        var id = 2;
//        var clas = $('#cacl-price-group .active_econom').attr('id');
//        if (clas === 'calc-price-group-business')
//            id = 3;
//        if (clas === 'calc-price-group-premium')
//            id = 4;
//        $("#cacl-price-window>li>a")
//            .removeClass("active_premium")
//            .not('[data-id!=' + id + ']')
//            .addClass('active_premium');
//    };
//}

/**
 * 
 * @param {type} $parent
 * @param {type} $elements
 * @param {type} $params
 * @returns {undefined}
 */
function Window($parent, $elements, $params)
{
    var _parent = $parent;
    var _this = this;

    var _min_width = {window: 0.4, door: 0.6};
    var _max_width = {window: 2.7, door: 2};
    var _min_length = {window: 0.9, door: 1.5};
    var _max_length = {window: 2.3, door: 3.0};
    var _change_type = {
        window: {width: {0: 1.0, 1: 1.7}, length: {0: 1.6}},
        door: {width: {0: 1.3}, length: {}}
    };
    var _elements = {
        Title: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #cacl-" + $elements.type + "-title",
        Length: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-length",
        Width: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-width",
        Enable: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-enable",
        Count: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-count",
        CountUp: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-countUp",
        CountDown: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-countDown",
        CountFlap: ".smeta_" + $elements.type + "[data-" + $elements.type + "='" + $elements.Id + "'][data-type-room='" + $elements.type_room + "'][data-id-room='" + $elements.id_room + "'] #calc-" + $elements.type + "-flap"
    };
    var _params = $params || {};

    _this.title = _params.title;
    _this.show = _params.show || true;
    _this.width = _params.width;
    _this.length = _params.length;
    _this.type_id = _params.type_id;
    _this.id = _params.id;
    _this.enable = _params.enable;

    _this.count = _params.count || 1;
    var min_count = 0;
    var max_count = 8;
    _this.flap = 2;
    _this.framuga = false;

    _this.materials = function()
    {
        var _materials = [];
        return _materials;
    };
    _this.getSize = function() {
        return (_this.getWidth() * _this.getLength()).toFixed(2);
    };
    _this.getPerimeter = function() {
        return (_this.getWidth() + _this.getLength()) * 2;
    };
    _this.getTypeId = function() {
        return _this.type_id;
    };
    _this.setTypeId = function($type_id) {
        _this.type_id = $type_id;
    };
    _this.getCount = function() {
        return _this.count;
    };
    _this.getEnable = function() {
        return _this.enable;
    };
    _this.getType = function() {
        return _this.type;
    };
    _this.getTitle = function() {
        return _this.title;
    };
    _this.getId = function() {
        return _this.id;
    };
    _this.getWidth = function() {
        return _this.width;
    };
    _this.setWidth = function($width) {
        _this.width = $width;
    };
    _this.getFlap = function() {
        return _this.flap;
    };
    _this.setFlap = function($flap) {
        if (_this.fla !== $flap) {
            _this.flap = $flap;
        }
    };
    _this.getLength = function() {
        return _this.length;
    };
    _this.setLength = function($length) {
        _this.length = $length;
    };
    _this.setEnable = function($enable) {
        _this.enable = $enable;
        if ($enable) {
            $(_elements.Enable).removeClass('ignored').addClass('ignore').attr('data-enable', _this.enable);
        } else {
            $(_elements.Enable).removeClass('ignore').addClass('ignored').attr('data-enable', _this.enable);
        }
    };
    _this.onChangeFlap = function() {
        if (_change_type[$elements.type]['width'][0] != undefined && _this.getWidth() >= _min_width[$elements.type] && _this.getWidth() <= _change_type[$elements.type]['width'][0]) {
            _this.setFlap(1);
        } else if (_change_type[$elements.type]['width'][1] != undefined && _this.getWidth() > _change_type[$elements.type]['width'][0] && _this.getWidth() <= _change_type[$elements.type]['width'][1]) {
            _this.setFlap(2);
        } else if (_change_type[$elements.type]['width'][1] != undefined && _this.getWidth() > _change_type[$elements.type]['width'][1] && _this.getWidth() <= _max_width[$elements.type]) {
            _this.setFlap(3);
        }
        if (_change_type[$elements.type]['length'][0] != undefined && _this.getLength() >= _min_length[$elements.type] && _this.getLength() <= _change_type[$elements.type]['length'][0]) {
            if (_this.framuga) {
                _this.framuga = false;
                if (_parent.windows_framuga.length == 0) {
                    _this.loadWindows();
                }
            }
        } else if (_change_type[$elements.type]['length'][0] != undefined && _this.getLength() > _change_type[$elements.type]['length'][0] && _this.getLength() <= _max_length[$elements.type]) {
            if (!_this.framuga) {
                _this.framuga = true;
                if (_parent.windows_framuga.length == 0) {
                    _this.loadWindows();
                }
            }
        }
        _this.updateFlap();
    }
    _this.updateFlap = function() {
        $(_elements.CountFlap).attr('data-type', _this.getFlap());
    };
    _this.onChangeWidth = function() {
        $(_elements.Enable).attr('data-enable', true);
        _this.setWidth(Number($(this).val().replace(/\,/, ".")));
        if (_this.getWidth() > _max_width[$elements.type]) {
            _this.setWidth(_max_width[$elements.type]);
            $(_elements.Width).val(_this.getWidth().toFixed(2).replace(/\./, ","));
        } else if (_this.getWidth() < _min_width[$elements.type]) {
            _this.setWidth(_min_width[$elements.type]);
            $(_elements.Width).val(_this.getWidth().toFixed(2).replace(/\./, ","));
        }
        _this.onChangeFlap();
    };
    _this.loadWindows = function() {
        _parent.ajaxLoad(true);
        // загрузка материалов
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            var cat;
            for (cat in smeta.rooms.room[0].categories) {
                if (Number(smeta.rooms.room[0].categories[cat].cat_id) == 29 && Number(smeta.rooms.room[0].categories[cat].number) - 5 == _this.getId()) {
                    _parent.windows_framuga = json;
                    _parent.ajaxLoad(false);
                }
            }

        };
        $.post('/json/getmaterial', {'cat_id': 29, framuga: _this.framuga}, _callback, "json");
    }
    _this.onChangeLength = function() {
        $(_elements.Enable).attr('data-enable', true);
        _this.setLength(Number($(this).val().replace(/\,/, ".")));
        if (_this.getLength() > _max_length[$elements.type]) {
            _this.setLength(_max_length[$elements.type]);
            $(_elements.Length).val(_this.getLength().toFixed(2).replace(/\./, ","));
        } else if (_this.getLength() < _min_length[$elements.type]) {
            _this.setLength(_min_length[$elements.type]);
            $(_elements.Width).val(_this.getLength().toFixed(2).replace(/\./, ","));
        }
        _this.onChangeFlap();
    };

    _this.onChangeEnable = function() {
        $(_elements.Enable).toggleClass("ignore ignored");
        if ($(_elements.Enable).hasClass('ignored')) {
            _this.enable = false;
        } else if ($(_elements.Enable).hasClass('ignore')) {
            _this.enable = true;
        }
        _this.setEnable(_this.enable);
        $(_elements.Enable).attr('data-enable', _this.enable);
        _this.onChangeFlap();
        _this.update();
    };
    _this.updateCount = function(obj) {
        var _room_type = $(obj).parents('.smeta_block smeta_window').data('type-room');
        var _room_id = $(obj).parents('.smeta_block smeta_window').data('id-room');
        var _room_window = $(obj).parents('.smeta_block smeta_window').data('window');

    }
    _this.onCount = function() {
        if (Number($(this).val()) > max_count) {
            $(this).val(max_count);
        } else if (Number($(this).val()) > min_count) {
            $(this).val(min_count);
        }
        _this.count = Number($(this).prev().val());
        _this.updateCount(this);

        _this.enable = true;
        _this.update();
    };
    _this.onCountUp = function() {
        if (Number($(this).prev().val()) + 1 <= max_count) {
            $(this).prev().val(Number($(this).prev().val()) + 1);
            _this.enable = true;
        }
        _this.count = Number($(this).prev().val());
        _this.updateCount(this);
        _this.update();
    };

    _this.onCountDown = function() {
        if (Number($(this).next().val()) - 1 >= min_count) {
            $(this).next().val(Number($(this).next().val()) - 1);
            _this.enable = true;
        }
        _this.count = Number($(this).next().val());
        _this.updateCount(this);
        _this.update();
    };

    _this.loadMaterial = function() {


    },
    _this.getPrice = function(_id_scroll, $type) {
        var type = {46: 1, 47: 2, 48: 3};
        _this.setFlap(type[$type]);
        var o3 = false;

        var area = Math.round(_this.getWidth() * _this.getLength() * 100);

        var stvorka1 = profil[_this.getFlap()][3];
        var stvorka2 = profil[_this.getFlap()][11];
        var stvorka3 = profil[_this.getFlap()][12];

        var base_window = profil[_this.getFlap()][3] + area * profil[_this.getFlap()][2];
        var base_povorot_window = profil[_this.getFlap()][4] + area * profil[_this.getFlap()][2];
        var base_povorot_otk_window = profil[_this.getFlap()][5] + area * profil[_this.getFlap()][2];

        var podokonnik = profil[_this.getFlap()][6] * _this.getWidth() * 10;
        var otkos_sht = profil[_this.getFlap()][7] * area;
        var otkos_plast = profil[_this.getFlap()][8] * area;
        var montaj = profil[_this.getFlap()][9] * area;
        var setka = profil[_this.getFlap()][10] * area;
        var framuga = profil[_this.getFlap()][13];
        var woodColor = profil[_this.getFlap()][14];

        if (_this.getWidth() >= 0.4 && _this.getWidth() <= 1.0) {
            base_window += stvorka1;
            base_povorot_window += stvorka1;
            base_povorot_otk_window += stvorka1;
        }
        if (_this.getWidth() >= 1.001 && _this.getWidth() <= 1.7) {
            base_window += stvorka2;
            base_povorot_window += stvorka2;
            base_povorot_otk_window += stvorka2;
        }
        if (_this.getWidth() >= 1.701 && _this.getWidth() <= 2.7) {
            base_window += stvorka3;
            base_povorot_window += stvorka3;
            base_povorot_otk_window += stvorka3;
        }

        if (_this.getLength() >= 1.601 && _this.getLength() <= 2.3) {
            base_window += framuga;
            base_povorot_window += framuga;
            base_povorot_otk_window += framuga;
        }

        switch (Number(_id_scroll)) {
//    switch (numberProfil) {
            case 0:
                o3 = base_window;
                break;
            case 1:
                o3 = base_window + montaj;
                break;
            case 2:
                o3 = base_window + montaj + otkos_sht;
                break;
            case 3:
                o3 = base_window + montaj + otkos_plast;
                break;
            case 4:
                o3 = base_window + montaj + otkos_plast + podokonnik;
                break;
            case 5:
                o3 = base_window + montaj + otkos_plast + podokonnik + setka;
                break;
            case 6:
                o3 = base_povorot_window;
                break;
            case 7:
                o3 = base_povorot_window + podokonnik;
                break;
            case 8:
                o3 = base_povorot_window + podokonnik + otkos_sht;
                break;
            case 9:
                o3 = base_povorot_window + podokonnik + otkos_plast;
                break;
            case 10:
                o3 = base_povorot_window + podokonnik + otkos_plast + montaj;
                break;
            case 11:
                o3 = base_povorot_window + podokonnik + otkos_plast + montaj + setka;
                break;
            case 12:
                o3 = base_povorot_otk_window;
                break;
            case 13:
                o3 = base_povorot_otk_window + podokonnik;
                break;
            case 14:
                o3 = base_povorot_otk_window + podokonnik + otkos_sht;
                break;
            case 15:
                o3 = base_povorot_otk_window + podokonnik + otkos_plast;
                break;
            case 16:
                o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj;
                break;
            case 17:
                o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka;
                break;
            case 18:
                if (_this.getLength() >= 0.9 && _this.getLength() <= 1.6) {
                    o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka + framuga;
                } else {
                    o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka;
                }
                break;
            case 19:
                o3 = base_povorot_otk_window + podokonnik + otkos_plast + montaj + setka + woodColor;
                if (_this.getLength() >= 0.9 && _this.getLength() <= 1.6) {
                    o3 += framuga;
                }
                break;
        }
        return o3;
    };
    /**
     * Return all material's group contets(html)
     *
     */
    _this.getGroups = function()
    {
        return "";
        /* var _materials	= _this.materials();
         var _i;
         var _content	= "<div><div><center class=\"title\">" + _this.getTitle() + "</center></div>";
         
         for(_i in _materials)
         {
         _content += _materials[_i].update();
         }
         
         return _content + "</div>";*/
    };
    _this.update = function()
    {
        _this.onChangeFlap();
        if (_elements.Title != undefined) {
            $(_elements.Title).html(_this.getTitle());
        }
        if (_elements.Length != undefined) {
            $(_elements.Length).val(_this.getLength().toFixed(2).replace(/\./, ","));
        }
        if (_elements.Width != undefined) {
            $(_elements.Width).val(_this.getWidth().toFixed(2).replace(/\./, ","));
        }
        if (_elements.Count != undefined) {
            $(_elements.Count).val(_this.getCount());
        }
        if (_elements.Enable != undefined) {
            $(_elements.Enable).removeClass('ignored, ignore').addClass('ignore' + (_this.getEnable() ? '' : 'd')).attr('data-enable', _this.getEnable());
        }
//        profilName.init();
    };

    _this.init = function()
    {
        $(document).on('change', _elements.Length, _this.onChangeLength);
        $(document).on('change', _elements.Width, _this.onChangeWidth);
        $(document).on('click', _elements.Enable, _this.onChangeEnable);
        $(document).on('change', _elements.Count, _this.onCount);
        $(document).on('click', _elements.CountUp, _this.onCountUp);
        $(document).on('click', _elements.CountDown, _this.onCountDown);
        _this.update();
    };

    _this.init();
}

