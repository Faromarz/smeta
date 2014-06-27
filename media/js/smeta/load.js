/*
 * smeta калькулятор
 *
 * @author 	senj
 * @version 1.1
 */
function Load($parent,flag) {
    if(flag===undefined){
        var flag_smeta=0;
    } else var flag_smeta=1;
    var _this = this;
    var _parent = $parent;
    _this.status = false;
    _this.count_load_json = 0;
    _this.ajaxLoad = function($status){
        if($status){
            $('body').append('<img src="/media/img/ajax-loader.gif" id="ajaxLoad" style="top: 50%;position: fixed;left: 50%;width: 180px;margin-left: -90px;height: 50px;margin-top: -25px;">');
        }else{
            $('body #ajaxLoad').remove();
        }
    };
    _this.loadAll = function() {
        _this.ajaxLoad(true);
        // загрузка категорий
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            var categories = json;
            for (var key in categories) {
                categories[key].repair_id = explode(',', categories[key].repair_id);
                if (categories[key].parent_id === "0") {
                    _parent.categories[categories[key].id] = categories[key];
                    _parent.categories[categories[key].id].group = [];
                } else {
                    _parent.categories[categories[key].id] = categories[key];
                    _parent.categories[categories[key].parent_id].group[categories[key].id] = categories[key];
                }
            }
            _this.count_load_json++;
            if (_this.count_load_json === 4) {
                _this.finishLoad();
            }
        };
        $.post('/json/getcat', [], _callback, "json");

        // загрузка материалов
        if(flag_smeta==1){
            var _callback = function(json) {
                if (json.error) {
                    alert(json.error);
                    return false;
                }
                _parent.materials = json;
                _this.count_load_json++;
                if (_this.count_load_json === 4) {
                    _this.finishLoad();
                }
            };
            $.post('/json/getmaterials_smeta', {'windows_type_id': 3, smeta: smeta_name}, _callback, "json");
        }else{
            var _callback = function(json) {
                if (json.error) {
                    alert(json.error);
                    return false;
                }
                _parent.materials = json;
                _this.count_load_json++;
                if (_this.count_load_json === 4) {
                    _this.finishLoad();
                }
            };
            $.post('/json/getmaterials', {'windows_type_id': 3}, _callback, "json");
        }
    // загрузка демонтажных работ
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            var room, cat, work;
            for (room in json){
                for (cat in json[room]){
                    for (work in json[room][cat]){
                        json[room][cat][work].repair_ids = explode(',', json[room][cat][work].repair_ids);
                    }
                }
            }
            _parent.works_dem = json;
            _this.count_load_json++;
            if (_this.count_load_json === 4) {
                _this.finishLoad();
            }
        };
        $.post('/json/getworks', {type: 0}, _callback, "json");

        // загрузка монтажных работ
        var _callback = function(json) {
            if (json.error) {
                alert(json.error);
                return false;
            }
            var room, cat, work;
            for (room in json){
                for (cat in json[room]){
                    for (work in json[room][cat]){
                        json[room][cat][work].repair_ids = explode(',', json[room][cat][work].repair_ids);
                    }
                }
            }
            _parent.works_mon = json;
            _this.count_load_json++;
            if (_this.count_load_json === 4) {
                _this.finishLoad();
            }
        };
        $.post('/json/getworks', {type: 1}, _callback, "json");

    };
    _this.finishLoad = function() {
        _this.ajaxLoad(false);
        _this.status = true;
        _parent.setInitCategory(true);
    };
    _this.init = function() {
       _this.loadAll();
    };
}
