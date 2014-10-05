/**
 * Door
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object}  $parent
 * @param {object}  $room
 * @param {integer} $key
 * @param {array}   $params
 */
function Door($parent, $room, $key, $params)
{
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

    // ID двери
    _this.getId = function() {
        return  id;
    };
    // type двери
    _this.getType = function() {
        return type;
    };
    // количество дверей
    _this.getCount = function() {
        return  count;
    };
    // количество дверей
    _this.setCount = function($count) {
        if ($count < 0) {
            $count = 0;
        }
        if ($count > 8) {
            $count = 8;
        }
        count = $count;
        $('#room0-door'+_key+'-count').val(number_format(count, 0, ',', ' '));
    };
    // увеличить количество
    _this.upCount = function() {
        _this.setCount((_this.getCount() + 1) <= 8 ? _this.getCount() + 1: 8);
    };
    // уменьшить количество
    _this.downCount = function() {
        _this.setCount((_this.getCount() - 1) >= 0 ? _this.getCount() - 1 : 0);
    };
    // ширина двери
    _this.getWidth = function() {
        return  width;
    };
    // изменить ширину двери
    _this.setWidth = function($width) {
        if ($width < Number(width_min)) {
            $width = Number(width_min);
        }
        if ($width > Number(width_max)) {
            $width = Number(width_max);
        }
        width = $width;
        var roomId = 0;
        if(_room !== null){
            roomId = _room.getId();
        }
        $('#room'+roomId+'-door'+_key+'-type').attr('data-type', (width >= 1.3 ? 2 : 1));
    };
    //  Высота двери
    _this.getHeight = function() {
        return height;
    };
    // установить высоту двери
    _this.setHeight = function($height) {
        if ($height < Number(height_min)) {
            $height = Number(height_min);
        }
        if ($height > Number(height_max)) {
            $height = Number(height_max);
        }
        height = $height;
    };
    // площадь двери
    _this.getSize = function() {
        return Number(_this.getWidth() * _this.getHeight());
    };
     // наличие галочки в двери
    _this.getEnable = function() {
        return enable;
    };
    // установка|снятие галочки в двери
    _this.setEnable = function($enable) {
        enable = $enable;
        var className = 'ignore_door ignore'; 
        if (!enable) {
            className += 'd';
        }
        if (_room === null) {
            $('.smeta_door[data-door-key="'+_key+'"] div.ignore_door').attr('class', className);
        } else {
            $('.smeta_door[data-room-id="'+_room.getId()+'"] div.ignore_door').attr('class', className);
        }
        
//        $('.smeta_room[data-room-id="'+_this.getId()+'"]').children('div:eq(2)').attr('class', 'room-enable ignore'+($enable?'':'d'));
    };
    // отображение двери
    _this.getShow = function() {
        return show;
    };
    // отображение/скрытие двери
    _this.setShow = function($show) {
        var _this = this;
        show = $show;
        _this.setEnable($show);
        if (_room === null) {
            $('.smeta_door[data-door-key="'+_key+'"]').show();
        } else if (_room.getId() !== 1) {
            if ($show) {
                $('.smeta_door[data-room-id="'+_room.getId()+'"]').show();
            } else {
                $('.smeta_door[data-room-id="'+_room.getId()+'"]').hide();
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
            type: _this.getType()
        };
        return params;
    };
    // удаление двери
    _this.removeDoor = function() {
        if (_room !== null && _room.getId() === 1){
            return true;
        }
    };
    // иницилизация комнаты
    _this.init = function() {
        var roomId = 0;
        if (_room !== null){
            roomId = _room.getId();
        }
        $('#'+roomId+'_door_'+_key+'_width')
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
        $('#'+roomId+'_door_'+_key+'_height')
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
        $('#room'+roomId+'-door'+_key+'-enable').on('click', function(){
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
        if (_room === null){
            $('#room'+roomId+'-door'+_key+'-up').on('click', function(){_this.upCount();});
            $('#room'+roomId+'-door'+_key+'-down').on('click', function(){_this.downCount();});
            $('#room'+roomId+'-door'+_key+'-count')
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
        }
    };
    _this.init();
}