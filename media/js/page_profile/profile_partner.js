
/**
 * Partner
 * @type Function
 */
var Partner = (function() {

    var defaults = {
        savePartner: 'lk_company-content-save_change',
        addStaff: 'lk_company-worker-add',
        removeStaff: 'lk_company-worker-block_close',
        removeUrl: '/profile/removestaff/',
        saveUrl: '/profile/savestaff/',
        saveStaff: 'lk_company-worker-block-save_change'
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
    //------------- добавление сотрудника
    Partner.prototype.addStaff = function($botton)
    {
        var _this = this;
        var url = $($botton).data('url');
        var data = {};
        var block = $($('#blockAddStaff').html());
        var bottonSave = block.find('.lk_company-worker-block-save_change');
        var bottonRemove = block.find('.'+defaults.removeStaff);
        var img = block.find('.uploadPhotoStaff');
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                response = JSON.parse(response);
                if(response.error) {
                    alert(response.error); return false;
                }
                $(bottonSave[0]).attr('data-id', response.id).on('click', function(){_this.saveStaff(this);});
                $(bottonRemove[0]).attr('data-id', response.id);
                $(img[0]).attr('data-url', '/profile/saveimgstaff/'+response.id).fileupload({
                    dataType: 'json',
                    fail: function (e, data) {
                        alert('Error upload');
                    },
                    done: function (e, data) {
                        var blocks = $(this).parents('.lk_company-worker-for_block');
                        var block = $(blocks[0]);
                        var photos = block.find('.lk_company-worker-block-photo');
                        var photo = $(photos[0]);
                        photo.attr('style', 'background:url("'+data.result.file+'") no-repeat 50% 50% #ffffff;');
                    },
                    add: function (e, data) {
                        if(confirm('Загрузить фото?')){
                            data.submit();
                        }
                    }
                })
                .prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
                $($botton).before(block);
            }
        }, 'json');
        return true;
    };
    //------------- удаление сотрудника
    Partner.prototype.removeStaff = function($botton)
    {
        var url = defaults.removeUrl + $($botton).data('id');
        var data = {};
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                response = JSON.parse(response);
                if(response.error) {
                    alert(response.error); return false;
                }
                $($botton).parent(".lk_company-worker-for_block").remove();
            }
        }, 'json');
        return true;
    };
    //------------- сохранить сотрудника
    Partner.prototype.saveStaff = function($botton)
    {
        var url = defaults.saveUrl + $($botton).data('id');
        var blocks = $($botton).parents('.lk_company-worker-for_block');
        var block = $(blocks[0]);
        var staffLastName = block.find('#staffLastName');
        var staffFirstName = block.find('#staffFirstName');
        var staffPosition = block.find('#staffPosition');
        var staffText = block.find('#staffText');
        var data = {};
        
        data.last_name = $(staffLastName).val();
        if(data.last_name == '') {
            $(staffLastName).focus();
            alert('Укажите имя сотрудника');
            return false;
        }
        data.first_name = $(staffFirstName).val();
        if(data.first_name == '') {
            $(staffFirstName).focus();
            alert('Укажите фамилию сотрудника');
            return false;
        }
        data.position = $(staffPosition).val();
        if(data.position == '') {
            $(staffPosition).focus();
            alert('Укажите должность сотрудника');
            return false;
        }
        data.text = $(staffText).val();
        if(data.text == '') {
            $(staffText).focus();
            alert('Укажите краткое описание сотрудника');
            return false;
        }
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(response) {
                response = JSON.parse(response);
                if(response.error) {
                    alert(response.error); return false;
                }
            }
        }, 'json');
        return true;
    };
    //------------- иницилизация партнера
    Partner.prototype.init = function(options)
    {
        var _this = this;
        var params = $.extend(defaults, options);
        
        // сохранение изменений
        $('#'+defaults.savePartner)
            .on('click', function(){
                _this.savePartner(this);
            });
        // добавление сотрудника
        $('#'+defaults.addStaff)
            .on('click', function(){
                _this.addStaff(this);
            });
        // Удаление сотрудника
        $('.'+defaults.removeStaff).die('click');
        $('.'+defaults.removeStaff)
            .live('click', function(){
                _this.removeStaff(this);
            });
        // сохранить сотрудника
        $('.'+defaults.saveStaff).die('click');
        $('.'+defaults.saveStaff)
            .live('click', function(){
                _this.saveStaff(this);
            });
            
        // загрузка картинки
        $('.uploadPhotoStaff')
            .fileupload({
                dataType: 'json',
                fail: function (e, data) {
                    alert('Error upload');
                },
                done: function (e, data) {
                    var blocks = $(this).parents('.lk_company-worker-for_block');
                    var block = $(blocks[0]);
                    var photos = block.find('.lk_company-worker-block-photo');
                    var photo = $(photos[0]);
                    photo.attr('style', 'background:url("'+data.result.file+'") no-repeat 50% 50% #ffffff;');
                },
                add: function (e, data) {
                    if(confirm('Загрузить фото?')){
                        data.submit();
                    }
                }
            })
            .prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
        
     

    };
    
    return new Partner();
    
})();
$(document).ready(function(){
    Partner.init();
});
