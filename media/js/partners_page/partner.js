
/**
 * Partner
 * @type Function
 */
var Partner = (function() {

    var defaults = {
        idCategory: 'categoriesPartner',
        idPartnersList: 'partnersList'
    };
    
    function Partner() {
    };
    
    // изменение категории
    Partner.prototype.categoryChange = function($obj){
        var _this = this;

        _this.preloader(true);
        $.ajax({
            type: "POST",
            url: "/ajax/partners/get",
            data: {
                "cat" : $($obj).val()
            },
            success: function(html){
                $('#'+defaults.idPartnersList).empty().append(html);
                _this.preloader(false);
            }
        }, 'json');
    };
    
    //------------- иницилизация 
    Partner.prototype.init = function(options)
    {
        var _this = this;
       
        var params = $.extend(defaults, options);
        
        // изменение категории
        $('#'+params.idCategory).on('change', function() {
            _this.categoryChange(this);
        });
    };
    //гифка прелоадера
    Partner.prototype.preloader = function(status){
        if(status){
            var width = $(window).width()-50;
            $('body').append('<div id="ajaxLoad" style="background:url(/media/img/block-window.gif) center center no-repeat; height: 56px; width:'+width+'px"></div>');
            $.fancybox.open({
                href: '#ajaxLoad',
                padding:0,
                maxWidth: 2048,
                maxHeight: 56,
                minWidth: width,
                minHeight: 56,
                scrolling: 'no',
                closeBtn: false,
                helpers   : {
                    overlay:
                    {
                        css: { 'background': 'rgba(255 , 255 , 250, 0.5)' },
                        closeClick: false
                    }
                }
            });
        }else{
            $.fancybox.close();
            $('body #ajaxLoad').remove();
        }
    };

    return new Partner();
    
})();
$(document).ready(function(){
    Partner.init();
});
