/*
 * Информаация о партнерах
 *
 * @author 	senj
 * @version 1.0
 */
function CalcRoomPartner($parent)
{
    var _this = this;
    var _parent = $parent;
    _this.partner_id = 0;
    _this.partner = [];
    _this.photos = [];
//	var _offset                     = 0;
//	var _block                      = $('#photos-partners');
//	var _partners                   = [];
//	var _partners_show              = [];
//	var _partners_load              = [];
//	var _load                       = true;
//	var user_chenge                 = false;
//	var text_no_photo                 = 'Примеры работ пока что не загружены';
//	var text_no_partners                 = 'В Вашем регионе в настоящий момент нет партёров ремонтных компаний. Смета учитывает региональные коэффициенты. Задайте параметры квартиры и скачайте в формате pdf или exl';
//	var text_help_all                 = 'Подсказка на все галочки';

//	_this.empty = function () {
//            _block.empty();
//            _partners = [];
//            _partners_show = [];
//            _partners_load = [];
//            _photos = [];
//            _block.attr('data-offset', 0);
//            _this.loadpartners();
//            _offset = 0;
//            _this.load();
//        }
//	_this.getPartners = function () {
//            return _partners;
//        }
//	_this.updateOffset = function () {
//            _block.attr('data-offset', Number(_block.attr('data-offset'))+1);
//            _offset = _block.attr('data-offset');
//        }
//	_this.loadpartners = function () {
//            _partners = [];
//            var country = $('#table_country').val();
//                var region = $('#table_'+country+' option:checked').attr('data-id');
//                var city = $('#region_'+region+' option:checked').attr('data-id');
//                if(city  == undefined)
//                    city = 0;
//            var _data_param = { city:city};
//            var _callback = function(data){
//                for(var key in data){                    
//                    _partners.push(data[key].user_id);
//                }
//            }
//            $.get('/load/partners', _data_param, _callback, "json");
//        }
    _this.loadPartner = function() {
        var _callback = function(json) {
            if (!json.error) {
                _this.partner = json;
            } else {
                alert(json.error);
            }
        }
        $.post('/json/getpartner', {'geo_id': _parent.rooms.geo_id, 'repair_id':_parent.rooms.repair_ebp}, _callback, 'json');
    }
    _this.load = function() {
//                _load = false;
//                _photos = [];
//                var country = $('#table_country').val();
//                var region = $('#table_'+country+' option:checked').attr('data-id');
//                var city = $('#region_'+region+' option:checked').attr('data-id');
//                if(city  == undefined)
//                    city = 0;
//
//                    var _data_param = {  offset: _offset,city:city};
//                    var _callback = function(data){
//                        if(data != 0){
//                            _this.photos	= data;
////                            _this.update();
////                            $('#show-partners').show().attr('data-open', 'off');
////                            $('#show-partners div').text('>> Показать работы других компаний <<');
////                        }else{
////                            if(_offset == 0){                                
////                                $('#show-partners').hide().attr('data-open', 'on');
////                                _block.append('<div class="name-compan">'+text_no_partners+'</div>'); 
////                            }
////                        }
//                    }
//                    $.get('/ajax/getphoto', {}, _callback, "json");
//            
    }
//	_this.update = function () {
//            var country = $('#table_country').val();
//                var region = $('#table_'+country+' option:checked').attr('data-id');
//                var city = $('#region_'+region+' option:checked').attr('data-id');
//                if(city  == undefined)
//                    city = 0;
//            for(var key in _photos){
//                if($.inArray(_photos[key].user_id, _partners_load) == -1){
//                    _block.append('<div class="name-compan"><span class="tooltip1 cler"><input type="checkbox" data-type="checkpartner"  id="checkpartner-'+_photos[key].id+'" name="checkpartner" value="'+_photos[key].user_id+'" '+(_photos[key].city_id == city?"checked":'')+' /><label for="checkpartner-'+_photos[key].id+'"></label><span class="helpic classic1">'+text_help_all+'</span></span><span class="tooltip1 cler"><span>'+_photos[key].name+' <img  class="tooltip1-img" src="/resources/images/quw.png" alt="" /></span><span class="partners partners-block"><div class="fade_block_f" style="display: block;">'+
//					    '<div class="grey_block">'+
//						'<div class="partners_fade_title">'+
//						    '<div class="img_block vertical_center"><img src="/resources/logotype/'+_photos[key].logo+'" height="60px;"></div>'+
//						    '<div class="text_block">'+
//							'<div class="title_block"><a target="_blank" href="'+_photos[key].site+'">'+_photos[key].name+'</a></div>'+
//							_photos[key].city+', '+_photos[key].country+' <br>'+_photos[key].phone+'<br>'+
//							'<a target="_blank" href="'+_photos[key].site+'">'+_photos[key].site+'</a>'+
//							' </div>'+													
//						'</div>'+
//						'<div class="partners_fade_text">'+_photos[key].descript+'</div>'+
//					    '</div>'+
//					'</div></span></span></div>');
//                    _block.append('<ul class="esp-block">'+
//                            '<li id="1-'+_photos[key].user_id+'"></li>'+
//                            '<li id="2-'+_photos[key].user_id+'"></li>'+
//                            '<li id="3-'+_photos[key].user_id+'"></li>'+
//                    '</ul>');
//                    if(_photos[key].img != null){
//                        $('.esp-block li#'+_photos[key].pricegroups_id+'-'+_photos[key].user_id).append('<div class="item">'+
//                                '<div class="img" data-title="'+_photos[key].text+'">'+
//                                    '<a title="'+escapeHtml(_photos[key].text)+'" rel="group'+_photos[key].user_id+'" href="/resources/images/par/'+_photos[key].img+'" class="fancybox">'+
//                                        '<img title="" alt="" src="/resources/images/par/290_'+_photos[key].img+'">'+
//                                    '</a>'+
//                                '</div>'+
//                        '</div>');
//                    }
//                    $(document).on('click','#checkpartner-'+_photos[key].id,_this.ChengeCheck);
//                    _this.updatePartners();
//                    $('.tooltip1-img').click(function (e) {
//     
// 
//      if (!$(this).parents('.tooltip1').hasClass('show-help')) {
//        $(this).parents('.tooltip1').toggleClass('show-help');
//        var yourClick = true;
//        $(document).bind('click.myEvent', function (e) {
//          if (!yourClick && $(e.target).closest('.show-help').length == 0) {
//            $('.tooltip1').removeClass('show-help');
//            $(document).unbind('click.myEvent');
//          }
//          yourClick = false;
//        });
//      }else{
//            $(this).parents('.tooltip1').toggleClass('show-help');
//        }
// 
//      e.preventDefault();
//    });
//                   
//
//                }else{
//                    
//                    $('.esp-block li#'+_photos[key].pricegroups_id+'-'+_photos[key].user_id).append('<div class="item">'+
//                            '<div class="img" data-title="'+_photos[key].text+'">'+
//                                '<a title="'+escapeHtml(_photos[key].text)+'" rel="group'+_photos[key].user_id+'" href="/resources/images/par/'+_photos[key].img+'" class="fancybox">'+
//                                    '<img title="" alt="" src="/resources/images/par/290_'+_photos[key].img+'">'+
//                                '</a>'+
//                            '</div>'+
//                    '</div>');
//                }
//            }
//            
//                if($('li#1-'+_photos[0].user_id+':empty').length != 0){
//                    $('.esp-block li#1-'+_photos[0].user_id).append('<div class="item">'+
//                        '<div class="img" data-title="'+escapeHtml(text_no_photo)+'">'+
//                            '<a title="'+escapeHtml(text_no_photo)+'" rel="group'+_photos[0].user_id+'" href="/resources/images/par/no_photo.png" class="fancybox">'+
//                                '<img title="" alt="" src="/resources/images/par/290_no_photo.png">'+
//                            '</a>'+
//                        '</div>'+
//                '</div>');
//                }
//                if($('li#2-'+_photos[0].user_id+':empty').length != 0){
//                    $('.esp-block li#2-'+_photos[0].user_id).append('<div class="item">'+
//                        '<div class="img" data-title="'+escapeHtml(text_no_photo)+'">'+
//                            '<a title="'+escapeHtml(text_no_photo)+'" rel="group'+_photos[0].user_id+'" href="/resources/images/par/no_photo.png" class="fancybox">'+
//                                '<img title="" alt="" src="/resources/images/par/290_no_photo.png">'+
//                            '</a>'+
//                        '</div>'+
//                '</div>');
//                }
//                if($('li#3-'+_photos[0].user_id+':empty').length != 0){
//                    $('.esp-block li#3-'+_photos[0].user_id).append('<div class="item">'+
//                        '<div class="img" data-title="'+escapeHtml(text_no_photo)+'">'+
//                            '<a title="'+escapeHtml(text_no_photo)+'" rel="group'+_photos[0].user_id+'" href="/resources/images/par/no_photo.png" class="fancybox">'+
//                                '<img title="" alt="" src="/resources/images/par/290_no_photo.png">'+
//                            '</a>'+
//                        '</div>'+
//                '</div>');
//                }
//                _this.updateOffset();
//            
//            _load = true;
//            
//        }
//        _this.ChengeCheckAll = function(){
//            user_chenge  = true;
//            $('input[data-type="checkpartner"]').attr('checked', $(this).prop('checked'));
//              _this.updatePartners();
//        }
//        _this.ChengeCheck = function(){
//            user_chenge  = true;
//            if($('input[data-type="checkpartner"]:checked').length == 0){
//                $('#checkpartner-all').attr('checked', false);
//            }else{
//                if(!$('#checkpartner-all').prop('ckecked')){
//                    $('#checkpartner-all').attr('checked', true);
//                }
//            }
//            _this.updatePartners();
//        }
//        _this.updatePartners = function(){
//            _partners_show = [];
//            _partners_load = [];
//            var par = $('input[data-type="checkpartner"]:checked');
//                if(par.length >0){
//                    for(var key in par){
//                        if(!isNaN(par[key].value))
//                        _partners_show.push(par[key].value);
//                    }
//                }
//            var par = $('input[data-type="checkpartner"]');
//                if(par.length >0){
//                    for(var key in par){
//                        if(!isNaN(par[key].value))
//                        _partners_load.push(par[key].value);
//                    }
//                }
//            if(user_chenge){
//                _partners = [];
//                _partners = _partners_show;
//            }
//            
//        }
    // показать скрыть партнеры
//	_this.show_partners = function () {
//            if($(this).attr('data-open') == 'off'){
//                $('#photos-partners>div').show();
//                $('#photos-partners>ul').show();
//                $('#photos-partners>ul').css('height', 'auto');
//                $(this).css('margin-top', '0px');
//                $(this).attr('data-open', 'on');
//                $(this).children('div').text('<< Скрыть работы других компаний >>');
//            }else{
//                $('#photos-partners>div').hide();
//                $('#photos-partners>ul').hide();
//                $('#photos-partners>ul').css('height', '40px');
//                $('#photos-partners>div:nth-child(1)').show();
//                $('#photos-partners>ul:nth-child(2)').show();
//                $(this).css('margin-top', '-53px');
//                $(this).attr('data-open', 'off');
//                $(this).children('div').text('<< Показать работы других компаний >>');
//                
//            }
//        }
    _this.init = function()
    {
//            _this.load();
        console.log('загрузка фоток партнера');
        // загрузка текста нет фото
//            var _data_param = { alias:'no_photo_partner'};
//            var _callback = function(data){
//                text_no_photo = data.title;
//            }
//            $.get('/load/gettext', _data_param, _callback, "json");
        // загрузка подсказки
//            var _data_param = { alias:46};
//            var _callback = function(data){
//                text_help_all = data.text;
//            }
//            $.get('/load/gethelps', _data_param, _callback, "json");
        // загрузка всех партнеров
//            _this.loadpartners();
        // галочка всех партенов
//           $(document).on('click','#checkpartner-all',_this.ChengeCheckAll);
        // прокрутка
//            $(window).scroll(function () {
//                if  ($(window).scrollTop() >= $(document).height() - $(window).height()-500){
//                    if(_load){                            
//                        _this.load();
//                    }
//                }
//           });
//           $(document).on('click', '#show-partners', _this.show_partners);
        // библиотека
//            $(".fancybox").fancybox({
//                'openEffect': 'none',
//                'closeEffect': 'none',
//                'nextEffect': 'none',
//                'prevEffect': 'none',
//                'titlePosition'	:	'inside',
//                'onComplete'	:	function() {
//                    jQuery("#fancybox-wrap").hover(
//                            function() {
//                                jQuery("#fancybox-title").show();
//                            },
//                            function() {
//                                jQuery("#fancybox-title").hide();
//                            });
//                        }
//                });
    }
}

