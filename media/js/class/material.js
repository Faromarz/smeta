/**
 * Material
 * 
 * @author senj senj@mail.ru
 * @version 1.0
 * 
 * @param {object} $parent
 * @param {object} $room
 * @param {array}  $params
 */
function Material($parent, $room, $params)
{
    var _this = this,
        _parent = $parent,
        _room = $room,
        _params = $params,
        _id = _params.id,
        _name = _params.name,
        _category_id = _params.category_id,
        _price = _params.price,
        _img = _params.img,
        _country = _params.country,
        _count_text = _params.count_text,
        _size = _params.size,
        _selected = _params.selected,
        _calc = _params.calc,
        _room_id = _params.room_id || 0;

    // ID материала
    _this.getId = function() {
        return _id;
    };
    // название материала
    _this.getName = function() {
        return _name;
    };
    // категория материала
    _this.getCategory = function() {
        return _category_id;
    };
    // цена материала
    _this.getPrice = function() {
        if ($.inArray(Number(_category_id), [46,47,48]) !== -1 && _room.window !== null) {
            return _room.window.getPrice(parseFloat(_price)-1);
        }
        return _price;
    };
    //  ссылка на материал
    _this.getUrl = function() {
        if ($.inArray(Number(_category_id), [46,47,48]) !== -1 && _room.window !== null) {
            return '/materials/view/'  + _this.getId()+'?width='+_room.window.getWidth()+'&height='+_room.window.getHeight()+'&type='+_room.window.getCountType()+'&offset='+(Number(_this.getSelected())+1);
        }
        return '/materials/view/'  + _this.getId()+'';
    };
    // картинка материала
    _this.getImg = function() {
        return _img;
    };
    // страна материала
    _this.getCountry = function() {
        return _country;
    };
    // формула расчета
    _this.getCalc = function() {
        return _calc;
    };
    // ед. измерения материала
    _this.getCount_text = function() {
        return _count_text;
    };
    // ед. измерения материала
    _this.getCount_text_ready = function() {
        var words = _this.getCount_text().split(',');
        return _this.declination(words[2], words[0], words[1], _this.count_material());
    };

    //расчет количества материала
    _this.count_material = function(){
        var calc = _this.getCalc();
        if (calc === 0) {
            return 0;
        } else if (parseInt(calc) === 1) {
            return 1;
        }
        var calculation = 0;
        var method = 'get'+calc;
        calculation = eval('_this.getRoom().'+method+'()');
        return Math.ceil(calculation/_this.getSize());
    };
    //склонение ед. измерений
    _this.declination = function(a, b, c, s) {
        var words = [a, b, c];
        var index = s % 100;

        if (index >=11 && index <= 14) { index = 0; }
        else { index = (index %= 10) < 5 ? (index > 2 ? 2 : index): 0; }

        return(words[index]);
    };
    // количество материала
    _this.getSize = function() {
        return _size;
    };
    // комната материала
    _this.getRoomId = function() {
        return _room_id;
    };

    // выбранный материала
    _this.getSelected = function() {
        return _selected;
    };
    // убрать выбранный материал
    _this.deleteSelected = function() {
        _selected = 0;
    };
    // выбрать материал
    _this.setSelected = function() {
        _selected = 1;
    };
    // комната
    _this.getRoom = function() {
        return _room;
    };
    // общая цена
    _this.getAllPrice = function() {
        var summa = (parseFloat(_this.count_material())*parseFloat(_this.getPrice()));
        return summa;
    };

    // иницилизация материала
    _this.init = function() {
        
    };
    _this.init();
}