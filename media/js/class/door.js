/**
 * Door
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object}  $parent
 * @param {integer} $key
 * @param {array}   $params
 */
function Door($parent, $key, $params)
{
    var _this = this;
    var _parent = $parent;
    var _params = $params;
    
    var key = $key;
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
    var isRoom = Number(_params.is_room) || 0;
    _this.isRoom = isRoom;
    _this.count = count;
    _this.type = type;
    _this.key = key;
    _this.show = show;

    // type двери
    _this.getType = function() {
        return type;
    };
    // номер двери 0-2
    _this.getKey = function () {
        return key;
    };
    // идентификатор двери
    _this.getIdentificator = function () {
        return 'door_type'+_this.getType()+'_key'+_this.getKey();
    };
    
    // дверь (для комнат или дополнительная)
    _this.getIsRoom = function() {
        return  isRoom;
    };
    _this.setIsRoom = function($isRoom) {
        isRoom = $isRoom;
    };
    // ID двери
    _this.getId = function() {
        return  id;
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
        var maxCount = 8;
        if ($count > maxCount) {
            $count = maxCount;
        }
        count = $count;
        if (count === 0){
            _this.setEnable(false);
        } else if(!_this.getEnable()) {
            _this.setEnable(true);
        }
        $('#'+_this.getIdentificator()+'-count').val(number_format(count, 0, ',', ' '));
        
        // если межкомнатные двери то изменяем в комнатах
        if (_this.getKey() === 0 && _this.getType() === 3){
            var countDoors = _parent.getCountDoorsInRoom();
            // если уменшили количество дверей
            if (countDoors > count) {
                var addCount = countDoors-count;
                $.each(_parent.rooms, function(key, room){
                    if (room.getType() !== 3 && room.getShow() && room.getDoorEnable() && addCount > 0) {
                        addCount--;
                        room.setEnable(false);
                    }
                });
            } else if (countDoors < count) {
                var addCount = count-countDoors;
                _parent.rooms.reverse();
                $.each(_parent.rooms, function(key, room){
                    if (room.getType() !== 3 && room.getShow() && !room.getDoorEnable() && addCount > 0) {
                        addCount--;
                        room.setEnable(true);
                    }
                });
                _parent.rooms.reverse();
            }
        }
    };
    // увеличить количество
    _this.upCount = function() {
        var maxCount = 8;
        if (_this.getKey() === 0 && _this.getType() === 3){
            maxCount = _parent.getMaxCountDoors();
        }
        _this.setCount((_this.getCount() + 1) <= maxCount ? _this.getCount() + 1: maxCount);
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
        $('#'+_this.getIdentificator()+'-type').attr('data-type', (width >= 1.3 ? 2 : 1));
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
        $('#'+_this.getIdentificator()+'-enable').attr('class', className);
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
        if (_this.getType() === 3) {
            $('.smeta_door[data-door-key="'+_this.getKey()+'"]').show();
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
    // иницилизация комнаты
    _this.init = function() {
        $('#'+_this.getIdentificator()+'-width')
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
        $('#'+_this.getIdentificator()+'-height')
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
        $('#'+_this.getIdentificator()+'-enable').on('click', function(){
            $(this).toggleClass("ignore ignored");
            if (_this.getIsRoom()){
                if ($(this).hasClass('ignore')) {
                    var count = 0;
                    $.each(_parent.rooms, function(key, room){
                        if (room.getType() !== 3 && room.getShow()) {
                            count++;
                            room.setEnable($(this).hasClass('ignore'));
                        }
                    });
                    _this.setCount(count);
                     // пересчет комнат
//                    if (_parent.getCountRooms() === 0) {
//                        var count = 0;
//                        if (_room.getType() === 1) {
//                            count = 1;
//                        }
//                        _parent.setCountRooms(count);
//                    }
                } else {
                    _this.setEnable( $(this).hasClass('ignore'));
                }
                console.log('пересчитать материалы, работы');
                
            }
        });
        if (_this.getType() === 3){
            $('#'+_this.getIdentificator()+'-up').on('click', function(){_this.upCount(); console.log('Нужен перерасчет сметы');});
            $('#'+_this.getIdentificator()+'-down').on('click', function(){_this.downCount();console.log('Нужен перерасчет сметы');});
            $('#'+_this.getIdentificator()+'-count')
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
                    console.log('Нужен перерасчет сметы');
                });
        }
    };
    _this.init();
}