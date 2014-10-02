
/**
 * Loaded
 * @type Function
 */
var Loaded = (function() {

    var defaults = {
        smetaId: null,
        rooms: new Array(),
        categories: new Array(),
        materials: new Array()
    };
    function Loaded() {
        this.parent;
        this.rooms;
        this.categories;
        this.materials;
    };
    // все загружено
    Loaded.prototype.finishLoad = function()
    {
        var _this = this;
        _this.parent.preloader(false);
        // иницилизация комнат
        $.each(_this.rooms, function(key, room) {
            _this.parent.rooms[key] = new Room(_this.parent, room);
        });
        console.log(_this.parent);
    };
    //---------- загрузка
    Loaded.prototype.load = function()
    {
        var _this = this;
        var load = 3;
        _this.parent.preloader(true);
        
        // загрузка комнат
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            _this.rooms = json;
            load--;
            if(load === 0){
                _this.finishLoad();
            }
        };
        $.post('ajax/rooms/get_rooms', {'smetaId': smetaId}, _callback, "json");
        
        // загрузка категорий
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            _this.categories = json;
            load--;
            if(load === 0){
                _this.finishLoad();
            }
        };
        $.post('ajax/materials/load_categories', {'smetaId': smetaId}, _callback, "json");

        // загрузка материалов
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            _this.materials = json;
            load--;
            if(load === 0){
                _this.finishLoad();
            }
        };
        $.post('ajax/materials/load_materials', {'smetaId': smetaId}, _callback, "json");
        
    };
    Loaded.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        smetaId = params.smetaId;
        _this.parent = params.parent;
        
        // загрузка
        _this.load();
    };

    return new Loaded();
})();