
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
    };

    return new Budget();
})();


$(document).ready(function(){
    // формат чисел min = 0 max = 99.99
    $(".input_filter_number")
        .keydown(function(e) {
            if (e.which > 37 || e.which > 40) {
                var minValue = 0.00;
                var maxValue = 99.99;
                var x = Number($(this).val().replace(/\,/, "."));
                if (parseFloat(x) > maxValue) {
                    $(this).val(maxValue.toFixed(2).replace(/\./, ","));
                }
                if (parseFloat(x) < minValue) {
                    $(this).val(minValue.toFixed(2).replace(/\./, ","));
                }
            }
        })
        .dblclick(function() {
            temp = this.value;
            this.value = '';
        })
        .blur(function() {
            if (this.value === '')
                this.value = temp;
            if (Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",") !== NaN) {
                this.value = Number(this.value.replace(/\,/, ".")).toFixed(2).replace(/\./, ",");
            }
            else {
                this.value = temp;
            }
        });

    //кнопка открытия комнат       
    $("#change_budget").on("click", function(){$("#budget_dop_options").slideDown(350); $("#budget_dop_options-hide").fadeIn(400, function() {  mail_top = $("#mail").offset().top;}); });
    //кнопка закрытия комнат 
    $("#budget_dop_options-hide").on("click", function(){$("#budget_dop_options").slideUp(350); $("#budget_dop_options-hide").fadeOut(400, function() {mail_top = $("#mail").offset().top;});} )
});


