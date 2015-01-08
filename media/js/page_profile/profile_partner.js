
/**
 * Partner
 * @type Function
 */
var Partner = (function() {

    var defaults = {
        savePartner: 'lk_company-content-save_change'
    };
    function Partner() {
    };


    //------------- сохранение инфо о партнере
    Partner.prototype.savePartner = function($botton)
    {
        var _this = this;
        var url = $($botton).data('url');
        var data = {};
        
        data.name = $('#partnerName').val();
        if(data.name == '') {
            $('#partnerName').focus();
            alert('Укажите название');
            return false;
        }
        data.descript = $('#partnerDescript').val();
        if(data.descript == '') {
            $('#partnerDescript').focus();
            alert('Укажите текст о компании');
            return false;
        }
        data.site = $('#partnerSite').val();
        if(data.site == '') {
            $('#partnerSite').focus();
            alert('Укажите сайт');            
            return false;
        }
        data.email = $('#partnerEmail').val();
        if(data.email == '') {
            $('#partnerEmail').focus();
            alert('Укажите Email');
            return false;
        }
        data.year = $('#partnerYear').val();
        if(data.year == '') {
            $('#partnerYear').focus();
            alert('Укажите год формирования компании');
            return false;
        }
        data.experience = $('#partnerExperience').val();
        if(data.experience == '') {
            $('#partnerExperience').focus();
            alert('Укажите средний опыт сотрудников');
            return false;
        }
        data.count_staff = $('#partnerCountStaff').val();
        if(data.count_staff == '') {
            $('#partnerCountStaff').focus();
            alert('Укажите количество сотрудников');
            return false;
        }
        data.count_project = $('#partnerCountProject').val();
        if(data.count_project == '') {
            $('#partnerCountProject').focus();
            alert('Укажите количество завершенных проектов');
            return false;
        }
        data.types_rate_id = $('#partnerTypesRateId').val();
        if(data.types_rate_id == '') {
            $('#partnerTypesRateId').focus();
            alert('Укажите сегмент рынка');
            return false;
        }
        data.group = $('#partnerGroup').val();
        if(data.group == '') {
            $('#partnerGroup').focus();
            alert('Укажите область специализации'); 
            return false;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                console.log(response);
                $($botton).css("background", "#84909a");
            }
        }, 'json');
    };
    //------------- иницилизация партнера
    Partner.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        
        $('#'+defaults.savePartner)
            .on('click', function(){
                _this.savePartner(this);
            });
        
     

    };
    
    return new Partner();
    
})();
$(document).ready(function(){
    Partner.init();
});
