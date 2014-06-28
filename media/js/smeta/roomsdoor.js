function RoomsDoor ($parent){

    var _parent = $parent;
    var _this = this;
    
    var profilId;
    
    _this.onLoad = function()
    {
       var _data = {
           'width' : 0,
           'heidht' : 0,
           'countflap':0
           
       };
       var _callbk = function(){
           
       };
       $.post('/ajax/getwindows', _data, _callbk, "json");
    };
    _this.init = function()
    {
                $("#add_door").on("click", function() {
                    if($('#add_door').parent().children('.smeta_door[data-type-room=1]').length <3){
                    $('#add_door').parent().children('.smeta_door').eq(1).clone(true).insertAfter($('#add_door').parent().children('.smeta_door[data-door]').last()).attr('data-door', $('#add_door').parent().children('.smeta_door[data-type-room=1]').length === 2?2:3).attr('data-id-room', $('#add_door').parent().children('.smeta_door[data-type-room=1]').length === 2?1:1).children('.smeta_text_header').remove();
                    var count = $('#add_door').parent().children('.smeta_door[data-type-room=1]').length;
                    _parent.rooms.room[0].door[count === 2?1:2].count = 1;
                    _parent.rooms.room[0].door[count === 2?1:2].show = true;
                    _parent.rooms.room[0].door[count === 2?1:2].update();
                }
            } );
    };

    _this.onProfilId = function ()
    {
        profilId = $(this).attr('data-id');
        _this.update();
    };

    _this.update = function (){
        var id= 2;
        var clas = $('#cacl-price-group .active_econom').attr('id');
        if(clas === 'calc-price-group-business')id = 3;
        if(clas === 'calc-price-group-premium')id = 4;
         $("#cacl-price-window>li>a")
                 .removeClass("active_premium")
                .not('[data-id!='+id+']')
                .addClass('active_premium');        
    };
}

/**
 * 
 * @param {object} $parent
 * @param {array} $elements
 * @param {array} $params
 * @returns {boolean}
 */
function Door($parent, $elements, $params)
{
    var _parent = $parent;
    var _this = this;

    var _min_width = {window: 0.4, door: 0.6};
    var _max_width = {window: 2.7, door: 2};
    var _min_length = {window: 0.9, door: 1.5};
    var _max_length = {window: 2.3, door: 3.0};
    var _change_type = {
        window: {
            width: {0: 1.0, 1: 1.7},
            length: {0: 1.6}
        },
        door: {
            width: {0: 1.3},
            length: {}
        }
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
        _this.flap = $flap;
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
            _this.framuga = false;
        } else if (_change_type[$elements.type]['length'][0] != undefined && _this.getLength() > _change_type[$elements.type]['length'][0] && _this.getLength() <= _max_length[$elements.type]) {
            _this.framuga = true;
        }
        _this.updateFlap();
    }
    _this.updateFlap = function() {
        $(_elements.CountFlap).attr('data-type', _this.getFlap());
        _this.loadWindows();
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
        _this.onChangeEnable();
    };
    _this.loadWindows = function() {
        console.log('Загрузили окна');
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
        _this.onChangeEnable();
    };

    _this.onChangeEnable = function() {
        $(this).toggleClass("ignore ignored");
        if ($(this).hasClass('ignored')) {
            _this.enable = false;
        } else if ($(this).hasClass('ignore')) {
            _this.enable = true;
        }
        _this.setEnable(_this.enable);
        $(_elements.Enable).attr('data-enable', _this.enable);
        _this.onChangeFlap();
        _this.update();
    };

    _this.onCount = function() {
        if (Number($(this).val()) > max_count) {
            $(this).val(max_count);
        } else if (Number($(this).val()) > min_count) {
            $(this).val(min_count);
        }
        _this.enable = true;
        _this.update();
    };
    _this.onCountUp = function() {
        if (Number($(this).prev().val()) + 1 <= max_count) {
            $(this).prev().val(Number($(this).prev().val()) + 1);
            _this.enable = true;
        }
        _this.count = Number($(this).prev().val());
        _this.update();
    };

    _this.onCountDown = function() {
        if (Number($(this).next().val()) - 1 >= min_count) {
            $(this).next().val(Number($(this).next().val()) - 1);
            _this.enable = true;
        }
        _this.count = Number($(this).next().val());
        _this.update();
    };

    _this.loadMaterial = function() {
        
    }
    _this.getPrice = function(_id_scroll) {

        var area = Math.round(_this.getWidth() * _this.getLength() * 100);

        var stvorka1 = profil[_this.getFlap()][3];
        var stvorka2 = profil[_this.getFlap()][11];
        var stvorka3 = profil[_this.getFlap()][12];

        var base_window = area * profil[_this.getFlap()][2];
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

        switch (_id_scroll) {
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
    return true;
}

