/**
 * Window
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object}  $parent
 * @param {object}  $room
 * @param {integer} $key
 * @param {array}   $params
 */
function Window($parent, $room, $key, $params)
{
    // нужна реализация цены
    var _this = this;
    var _parent = $parent;
    var _room = $room;
    var _key = $key;
    var _params = $params;
    
    var id = Number(_params.id);
    var type = Number(_params.type);
    var width = Number(_params.width);
    var width_min = Number(_params.width_min);
    var width_max = Number(_params.width_max);
    var height = Number(_params.height);
    var height_min = Number(_params.height_min);
    var height_max = Number(_params.height_max);
    var enable = Number(_params.enable) || false;
    var show = Number(_params.show) || false;
    var count = Number(_params.count) || 1;
    var count_type = Number(_params.count_type);

    // ID окна
    _this.getId = function() {
        return  id;
    };
    // ID комнаты
    _this.getRoomId = function() {
        var roomId = 0;
        if (_room !== null){
            roomId = _room.getId();
        }
        return  roomId;
    };
    // type окна
    _this.getType = function() {
        return type;
    };
    // количество окон
    _this.getCount = function() {
        return  count;
    };
    // количество створок
    _this.getCountType = function() {
        return  count_type;
    };
    // количество створок
    _this.setCountType = function($count) {
        count_type = $count;
    };
    // количество окон
    _this.setCount = function($count) {
        if ($count < 0) {
            $count = 0;
        }
        if ($count > 8) {
            $count = 8;
        }
        count = $count;
        $('#room'+_this.getRoomId()+'-window'+_key+'-count').val(number_format(count, 0, ',', ' '));
        console.log('пересчитать материалы, работы');
    };
    // увеличить количество
    _this.upCount = function() {
        _this.setCount((_this.getCount() + 1) <= 8 ? _this.getCount() + 1: 8);
        console.log('пересчитать материалы, работы');
    };
    // уменьшить количество
    _this.downCount = function() {
        _this.setCount((_this.getCount() - 1) >= 0 ? _this.getCount() - 1 : 0);
        console.log('пересчитать материалы, работы');
    };
    // ширина окона
    _this.getWidth = function() {
        return  width;
    };
    // изменить ширину окна
    _this.setWidth = function($width) {
        if ($width < Number(width_min)) {
            $width = Number(width_min);
        }
        if ($width > Number(width_max)) {
            $width = Number(width_max);
        }
        width = $width;
        type = 2;
        if ($width <= 1) {
            type = 1;
        }else if($width > 1.7){
            type = 3;
        }
        _this.setCountType(type);
        $('#room'+_this.getRoomId()+'-window'+_key+'-type').attr('data-type', type);
    };
    //  Высота окна
    _this.getHeight = function() {
        return height;
    };
    // установить высоту окна
    _this.setHeight = function($height) {
        if ($height < Number(height_min)) {
            $height = Number(height_min);
        }
        if ($height > Number(height_max)) {
            $height = Number(height_max);
        }
        height = $height;
    };
    // площадь окна
    _this.getSize = function() {
        return Number(_this.getWidth() * _this.getHeight());
    };
     // наличие галочки в окнах
    _this.getEnable = function() {
        return enable;
    };
    // установка|снятие галочки в окон
    _this.setEnable = function($enable) {
        enable = $enable;
        var className = 'ignore_window ignore'; 
        if (!enable) {
            className += 'd';
        }
        if (_room === null) {
            $('.smeta_window[data-window-key="'+_key+'"] div.ignore_window').attr('class', className);
        } else {
            $('.smeta_window[data-window-id="'+_room.getId()+'"] div.ignore_window').attr('class', className);
        }
        
//        $('.smeta_room[data-room-id="'+_this.getId()+'"]').children('div:eq(2)').attr('class', 'room-enable ignore'+($enable?'':'d'));
    
    };
    // отображение окна
    _this.getShow = function() {
        return show;
    };
    // отображение/скрытие окна
    _this.setShow = function($show) {
        var _this = this;
        show = $show;
        _this.setEnable($show);
        if (_room === null) {
            $('.smeta_window[data-window-key="'+_key+'"]').show();
        } else if (_room.getId() !== 1) {
            if ($show) {
                $('.smeta_window[data-room-id="'+_room.getId()+'"]').show();
            } else {
                $('.smeta_window[data-room-id="'+_room.getId()+'"]').hide();
            }
            
        }
    };
    // параметры для сметы
    _this.getParams = function() {
        var  params = {
            width: _this.getWidth(),
            height: _this.getHeight(),
            enable: _this.getEnable(),
            show: _this.getShow(),
            id: _this.getId(),
            count: _this.getCount(),
            type: _this.getType(),
            count_type: _this.getCountType()
        };
        return params;
    };
    _this.getPrice = function($scroll) {
        var o3 = false;
        var area = Math.round(_this.getWidth() * _this.getHeight() * 100);
        
        var type=_this.getCountType()-1;
        
        var stvorka1 = Number(Loaded.okna[type]['base_gluh']);
        var stvorka2 = Number(Loaded.okna[type]['stvorka2']);
        var stvorka3 = Number(Loaded.okna[type]['stvorka3']);

        var base_window = Number(Loaded.okna[type]['base_gluh']) + area * Number(Loaded.okna[type]['price']);
        var base_povorot_window = Number(Loaded.okna[type]['base_povorot']) + area * Number(Loaded.okna[type]['price']);
        var base_povorot_otk_window = Number(Loaded.okna[type]['base_povorot_otk']) + area * Number(Loaded.okna[type]['price']);

        var podokonnik = Number(Loaded.okna[type]['podokonnik_otliv']) * _this.getWidth() * 10;
        var otkos_sht = Number(Loaded.okna[type]['otkos_shtuk']) * area;
        var otkos_plast = Number(Loaded.okna[type]['otkos_plastik']) * area;
        var montaj = Number(Loaded.okna[type]['montaj']) * area;
        var setka = Number(Loaded.okna[type]['setka']) * area;
        var framuga = Number(Loaded.okna[type]['framuga']);
        var woodColor = Number(Loaded.okna[type]['color_wood']);

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

        if (_this.getHeight() >= 1.601 && _this.getHeight() <= 2.3) {
            base_window += framuga;
            base_povorot_window += framuga;
            base_povorot_otk_window += framuga;
        }

        switch (Number($scroll)) {
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
    // удаление окна
    _this.removeWindow = function() {
        if (_room !== null && _room.getId() === 1){
            return true;
        }
    };
    // иницилизация окон
    _this.init = function() {
        
        $('#'+_this.getRoomId()+'_window_'+_key+'_width')
            .dblclick(function() {
                temp = this.value;
                this.value = '';
            })
            .blur(function() {
                if (this.value === ''){
                    this.value = temp;
                }
                if (Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",") !== NaN) {
                    _this.setWidth(Number(this.value.replace(/\,/, ".")));
                    this.value = number_format(_this.getWidth(), 2, ',', ' ');
                    console.log('обновить материалы, работы');
                } else {
                    this.value = temp;
                }
            });
        $('#'+_this.getRoomId()+'_window_'+_key+'_height')
            .dblclick(function() {
                temp = this.value;
                this.value = '';
            })
            .blur(function() {
                if (this.value === ''){
                    this.value = temp;
                }
                if (Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",") !== NaN) {
                    _this.setHeight(Number(this.value.replace(/\,/, ".")));
                    
                    this.value = number_format(_this.getHeight(), 2, ',', ' ');
                    console.log('обновить материалы, работы');
                } else {
                    this.value = temp;
                }
            });
        $('#room'+_this.getRoomId()+'-window'+_key+'-enable').on('click', function(){
            $(this).toggleClass("ignore ignored");
            if (_room !== null){
                if ($(this).hasClass('ignore')) {
                    _room.setEnable($(this).hasClass('ignore'));
                     // пересчет комнат
                    if (_parent.getCountRooms() === 0) {
                        var count = 0;
                        if (_room.getType() === 1) {
                            count = 1;
                        }
                        _parent.setCountRooms(count);
                    }
                } else {
                    _this.setEnable( $(this).hasClass('ignore'));
                }
                console.log('пересчитать материалы, работы');
                
            }
        });
        $('#room'+_this.getRoomId()+'-window'+_key+'-up').on('click', function(){_this.upCount();});
        $('#room'+_this.getRoomId()+'-window'+_key+'-down').on('click', function(){_this.downCount();});
        $('#room'+_this.getRoomId()+'-window'+_key+'-count')
            .dblclick(function() {
                temp = this.value;
                this.value = '';
            })
            .blur(function() {
                if (this.value === ''){
                    this.value = temp;
                }
                if (Number(this.value.replace(/\,/, ".")).toFixed(0) !== NaN) {
                    _this.setCount(Number(this.value.replace(/\,/, ".")));
                } else {
                    this.value = temp;
                }
            });
    };
    _this.init();
}