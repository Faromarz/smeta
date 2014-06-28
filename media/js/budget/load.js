/*
 * smeta калькулятор
 *
 * @author 	senj
 * @version 1.1
 */
function LoadModific($parent) {
    var _parent = $parent;
    var _this = _parent.load;

    _this.finishLoad = function() {
        _this.ajaxLoad(false);
        _this.status = true;
        _parent.setInitCategory(true);
   
    };
}
