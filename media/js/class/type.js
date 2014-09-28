
/**
 * Type
 * @type Function
 */
var Type = (function() {

    var defaults = {
        rate: 1,
        repair: 1,
        apartment: 1
    };
    function Type() {
        this.rate = 1;
        this.repair = 1;
        this.apartment = 1;
    };
    
    Type.prototype.getAllTypes = function() {
        return [
            this.getRate(),
            this.getRepair(),
            this.getApartment()
        ];
    };
    Type.prototype.getRate = function() {
        return this.rate;
    };
    Type.prototype.getRepair = function() {
        return this.repair;
    };
    Type.prototype.getApartment = function() {
        return this.apartment;
    };
    // изменнение тарифа
    Type.prototype.changeRate = function($obj) {
        var _this = this;
        $("#order_options_rate li").removeClass("selected");
        $("#choose_rate li").removeClass("choose_rate_selected");
        _this.setTypes($($obj).index(), null, null);
        var id = $($obj).attr("id");
        
        if ($.inArray(id, ['order_options_rate_econom','choose_rate_econom']) !== -1) {
            $("#choose_rate_econom").addClass('choose_rate_selected');
            $("#order_options_rate_econom").addClass('selected');
            $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide(); });
            $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide(); });
            setTimeout(function(){ $("#examples_works_slider_econom").show(function() {$("#examples_works_slider_econom").children('div').fadeIn(); }); }, 500);
        }
        if ($.inArray(id, ['order_options_rate_standart','choose_rate_standart']) !== -1) {
            $("#choose_rate_standart").addClass('choose_rate_selected');
            $("#order_options_rate_standart").addClass('selected');
            $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide(); });
            $("#examples_works_slider_premium").children('div').fadeOut(400, function() { $("#examples_works_slider_premium").hide(); });
            setTimeout(function(){ $("#examples_works_slider_standart").show(function() {$("#examples_works_slider_standart").children('div').fadeIn(); }); }, 500);

        }
        if ($.inArray(id, ['order_options_rate_premium','choose_rate_premium']) !== -1) {
            $("#choose_rate_premium").addClass('choose_rate_selected');
            $("#order_options_rate_premium").addClass('selected');
            $("#examples_works_slider_standart").children('div').fadeOut(400, function() { $("#examples_works_slider_standart").hide() });
            $("#examples_works_slider_econom").children('div').fadeOut(400, function() { $("#examples_works_slider_econom").hide() });
            setTimeout(function(){ $("#examples_works_slider_premium").show(function() {$("#examples_works_slider_premium").children('div').fadeIn(); }); }, 500);
        }
    };
    // изменение ремонта
    Type.prototype.changeRepair = function($obj) {
        var _this = this;
        $("#order_options_repairs li").removeClass("selected");
        $($obj).addClass("selected");
        _this.setTypes(null,$($obj).index(),null);
    };
    // изменение апартаментов
    Type.prototype.changeApartment = function($obj) {
        var _this = this;
        $("#order_options_type li").removeClass("selected");
        $($obj).addClass("selected");
        _this.setTypes(null,null,$($obj).index());
    };
    // установка типов ремонта
    Type.prototype.setTypes = function(rate, repair, apartment) {
        var _this = this;
        if (rate!==null) {
            _this.rate = rate;
        }
        if (repair!==null) {
            _this.repair = repair;
        }
        if (apartment!==null) {
            _this.apartment = apartment;
        }
    };
    //------------- иницилизация тип ремонта
    Type.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        //типы ремонта
        $.each(params, function(key, type) {
            _this[key] = type;
        });
        //-------выбор тарифа, ремонта и типа квартиры
        $("#choose_rate, #order_options_rate").on("click", 'li', function(){_this.changeRate(this);});
        $("#order_options_repairs").on("click", 'li', function(){_this.changeRepair(this);});
        $("#order_options_type").on("click", 'li', function(){_this.changeApartment(this);});
    };

    return new Type();
})();