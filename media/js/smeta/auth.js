/*
 * smeta калькулятор
 *
 * @author 	senj
 * @version 1.0
 */
function Auth() {
    var _this = this;

    _this.authorization = function() {
        $("#overlap").show();
    $("#pop_up").show();
    $("#close_pop_up").show();
    $("#authorization").show();
    }

    _this.close_authorization = function() {
       $("#overlap").hide();
    $("#pop_up").hide();
    $("#close_pop_up").hide();
    $("#authorization").hide();
    $("#registration").hide();
    $("#remind_password").hide();
    $("#pop_up-add_review").hide();
    }

    _this.init = function() {
        $("#privat p").on("click", _this.authorization);
        $(".privatAuth").on("click", _this.authorization);
        $("#close_pop_up").on("click", _this.close_authorization);

    }
}


$(document).ready(function() {
    smeta.auth = new Auth();
    smeta.auth.init();
});