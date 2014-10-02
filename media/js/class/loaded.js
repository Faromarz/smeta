
/**
 * Height
 * @type Function
 */
var Height = (function() {

    var defaults = {
        step: 0.10,
        height: 0,
        height_min: 0,
        height_max: 0,
        name: '',
        block: '#input_ceiling',
        down: '.button_minus.height',
        up: '.button_plus.height',
        parent: null
    };
    function Height() {
        this.height = 0;
    };
    // получить высоту
    Height.prototype.getHeight = function() {
        return this.height;
    };
    // установка высоты
    Height.prototype.setHeight = function($height) {
        var _this = this;
        if ($height < Number(defaults.height_min)) {
            $height = Number(defaults.height_min);
        }
        if ($height > Number(defaults.height_max)) {
            $height = Number(defaults.height_max);
        }
        _this.height = $height;
        $(defaults.block).val(number_format(_this.height, 2, ',', ' '));
        $('#budget_repair_estimate-type_and_rate').find('dd:eq(1)').text(number_format(_this.height, 2, ',', ' ')+' м');
        defaults.parent.update();
    };
    // увеличить высоту
    Height.prototype.upHeight = function() {
        var _this = this;
        _this.setHeight((_this.getHeight() + defaults.step) <= defaults.height_max ? _this.getHeight() + defaults.step : defaults.height_max);
    };
    // уменьшить высоту
    Height.prototype.downHeight = function() {
        var _this = this;
        _this.setHeight((_this.getHeight() - defaults.step) >= defaults.height_min? _this.getHeight() - defaults.step : defaults.height_min);
    };
    //------------- иницилизация высоты
    Height.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        //типы ремонта
        _this.setHeight(Number(params.height));
        defaults.height_min = Number(params.height_min);
        defaults.height_max = Number(params.height_max);
        defaults.name = params.name;
        defaults.parent = params.parent;
        
        $(defaults.up).on('click', function(){_this.upHeight();});
        $(defaults.down).on('click', function(){_this.downHeight();});
        $(defaults.block)
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
                } else {
                    this.value = temp;
                }
            });
    };

    return new Height();
})();