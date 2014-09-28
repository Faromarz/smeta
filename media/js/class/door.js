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
    
    var width = Number(_params.width);
    var width_min = Number(_params.width_min);
    var width_max = Number(_params.width_max);
    var height = Number(_params.height);
    var height_min = Number(_params.height_min);
    var height_max = Number(_params.height_max);
    var enable = Number(_params.enable) || false;
    var show = Number(_params.show) || false;
    var count = Number(_params.count) || 1;

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
    // изменение высоты двери
    _this.changeHeight = function($obj) {
        _this.setHeight($($obj).val().replace(/\,/, "."));
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
//        $('.smeta_room[data-room-id="'+_this.getId()+'"]').children('div:eq(2)').attr('class', 'room-enable ignore'+($enable?'':'d'));
    console.log('пересчитать материалы, работы');
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
        }

        // отображение/скрытие двери (type == 1)
//        if(_room.getType() === 1) {
//            if (show) {
//                var length = $('.smeta_room[data-room]').length;
//                if(_this.getId()>length){
//                    $("#add_room").siblings('.smeta_room').eq(0).clone(true).insertBefore('#add_room').attr('data-room', $('.smeta_room[data-room]').length).attr('data-room-id', $('.smeta_room[data-room]').length);
//                    $("#add_room").siblings('.smeta_room').eq(_this.getId()-1).find('p.smeta_text_header').eq(0).text(_this.getTitle());
//                }
//            } else {
//                if (_this.getId() !== 1) {
//                    _this.removeRoom();
//                }
//            }
//        }
    };

    // параметры для сметы
    _this.getParams = function() {
        var  params = {
            width: _this.getWidth(),
            height: _this.getHeight(),
            enable: _this.getEnable(),
            show: _this.getShow()
        };
        return params;
    };
    // удаление двери
    _this.removeDoor = function() {
        if (_room !== null && _room.getId() === 1){
            return true;
        }
//        // удаление комнаты
//        $("#add_room").siblings('.smeta_room[data-room='+_this.getId()+']').remove();
//        // удаление окон вынести в окна
//        $("#add_window").siblings('.smeta_window[data-room='+_this.getId()+']').remove();
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
//        
//        // click enable room
//        $(htmlBlock+'[data-room-id="'+_this.getId()+'"] div:eq(6)').live("click", function() {
//            $(this).toggleClass("ignore ignored");
//            _this.setEnable($(this).hasClass('ignore'));
//            // пересчет комнат
//            if (_parent.getCountRooms() === 0) {
//                var count = 0;
//                if (_this.getType() === 1) {
//                    count = 1;
//                }
//                _parent.setCountRooms(count);
//            }
//         });
//        // click balcon
//        $(htmlBlock+'[data-room-id="'+_this.getId()+'"] div:eq(5)').live("click", function() {
//            $(this).toggleClass("check_box_out check_box_in");
//            _this.setBalcon($(this).hasClass('check_box_in'));
//         });
    };
    _this.init();
}