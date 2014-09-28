
/**
 * Smeta
 * @type Function
 */
var Budget = (function() {

    var defaults = {
        rooms: new Array(),
        types: new Array()
    };

    function Budget() {};
    Budget.prototype = Smeta;

    Budget.prototype.init = function(options){
        Smeta.constructor.prototype.init.call(this, options);
        
         //кнопка открытия комнат       
    $("#change_budget").on("click", function(){$("#budget_dop_options").slideDown(350); $("#budget_dop_options-hide").fadeIn(400, function() {  mail_top = $("#mail").offset().top;}); });
    //кнопка закрытия комнат 
    $("#budget_dop_options-hide").on("click", function(){$("#budget_dop_options").slideUp(350); $("#budget_dop_options-hide").fadeOut(400, function() {mail_top = $("#mail").offset().top;});});
    };

    return new Budget();
})();


