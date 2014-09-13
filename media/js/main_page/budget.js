function Smeta(){
    var _this = this;
    _this.name = false;
    _this.smeta_values = new Array();
    _this.rooms = new Array();
    _this.categories_materials = new Array();
    _this.materials = new Array();
    _this.categories_works = new Array();
    _this.works = new Array();

    _this.init = function(name){
        _this.name = name;
        _this.load_smeta();
    };

    //загрузка категорий материалов
    _this.load_smeta = function(){
        _this.preloader(true);
        $.ajax({
            type: "POST",
            url: "../ajax/smeta/load",
            data: {"smeta" : _this.name },
            success: function(data){
                var result = JSON.parse( data );
                _this.smeta_values = $.extend(true, [], result);
                _this.load_rooms();
            }
        }, 'json');
    };

    //загрузка комнат
    _this.load_rooms = function(){
        $.ajax({
            type: "POST",
            url: "../ajax/rooms/load_rooms_smeta",
            data: {"id" : _this.smeta_values[0]['id'] },
            success: function(data){
                var result=JSON.parse( data );
                _this.rooms = $.extend(true, [], result);
                console.log(_this.rooms);
                _this.load_categories();
            }
        }, 'json');
    }

    //загрузка категорий материалов
    _this.load_categories = function(){
        $.ajax({
            type: "POST",
            url: "../ajax/materials/load_categories",
            success: function(data){
                var result = JSON.parse( data );
                _this.categories_materials = $.extend(true, [], result);
                _this.load_materials();
            }
        }, 'json');
    };

    //загрузка материалов для категории
    _this.load_materials = function(){
        $.ajax({
            type: "POST",
            url: "../ajax/materials/load_materials",
            data: {"id" : _this.smeta_values[0]['id'] },
            success: function(data){
                var result=JSON.parse( data );
                _this.materials = $.extend(true, [], result);
                _this.load_categories_works();
            }
        }, 'json');
    };

    //загрузка категорий работ
    _this.load_categories_works = function(){
        $.ajax({
            type: "POST",
            url: "../ajax/works/load_categories_works",
            success: function(data){
                var result=JSON.parse( data );
                _this.categories_works = $.extend(true, [], result);
                _this.load_works();
            }
        }, 'json');
    };

    //загрузка работ
    _this.load_works = function(){
        $.ajax({
            type: "POST",
            url: "../ajax/works/load_works",
            success: function(data){
                var result=JSON.parse( data );
                _this.works = $.extend(true, [], result);
                _this.preloader(false);
            }
        }, 'json');
    };

    //отрисовка материалов всех - по категориям
    _this.paint_materials = function(numb){
        var rooms_cat_parents = new Array(),
            rooms_cat_under = new Array(),
            rooms_material = new Array();
        $.each(_this.rooms[numb]['materials'], function(room_key, room_val) {
            rooms_cat_parents.push(room_val.cat_id);
            rooms_cat_under.push(room_val.under_id);
            rooms_material.push(room_val.mat_id);
        });
        var text = '';
        $.each(_this.categories_materials, function(k, v) {
            if ($.inArray(v.id,rooms_cat_parents)!= -1){
                var ide = v.id, calc = v.calculation;
                var selected = _this.get_selected_material_room(v.id,numb),
                    selected_key = _this.get_key_material(selected.id),
                    ignored = _this.get_show_material(selected.id,numb) ? 'ignore_4' : 'ignored_4';
                text += '<div class="materials_room_option" id="category-'+ide+'">' +
                    '<div class="materials_room_option_header">' +
                    '<p>'+ v.name+'</p>' +
                    '<div class="'+ignored+'" data-mat="'+selected.id+'"></div>' +
                    '</div>';
                if (v.under.length >0){
                    text += '<select class="selectbox" id="val-'+v.id+'" >';
                    $.each(v.under, function(key, val) {
                        var select_option = '';
                        if($.inArray(val.id,rooms_cat_under)!= -1) {
                            select_option = 'selected = "selected"';
                            ide = val.id;
                            calc = val.calculation;
                        }
                        text += '<option value="'+val.id+'" '+select_option+'>'+val.name+'</option>';
                    });
                    text += '</select>';
                } else text += '<div class="materials_room_option_menu"></div>';

                var min_material = _this.get_min_material(ide),
                    max_material = _this.get_max_material(ide),
                    count_material = _this.count_material(calc,numb),
                    words = selected.count_text.split(',');

                text += '<div class="materials_room_option_slider" id="material-slider-'+ide+'">' +
                    '       <div class="slider-materials-' + ide + '" style="position: relative">'+
                    '           <div class="ui-slider-handle ui-state-default ui-corner-all"><h6 class="slider_price price-materials-' + ide + '">' + selected.price + ' р</h6></div>'+
                    '       </div>'+
                    '     <div class="slider_img" style="background-image: url(/media/img/material/' + selected.img + ')"' + '>'+
                    '    <div class="slider_about">'+
                    '        <a href="#" class="mat-name-' + ide + '">' + selected.name + '</a>'+
                    '          <h6 class="city-name-' + ide + '">' + selected.country + '</h6>'+
                    '    </div>'+
                    '    </div>'+
                    '</div>' +
                    '<div class="x"></div>' +
                    '<h1>'+count_material+' '+_this.declination(words[2], words[0], words[1], count_material)+' =</h1>' +
                    '<h2 class="mat-price-all-' + ide + '">'+(parseFloat(count_material)*parseFloat(selected.price))+' р.</h2>' +

                    '<script>'+
                    "$('.slider-materials-" + ide + "').slider({"+
                    "min: " + min_material + ","+
                    "orientation : 'vertical',"+
                    "value: " + selected_key + ","+
                    'max: '+ max_material +','+
                    "step: 1,"+
                    "create: function () {"+
                    "},"+
                    "slide: function (e, ul) { "+
                    '   $(".price-materials-' + ide + '").text(smeta.get_materials_slider(ul.value).price+" р");'+
                    '   $(".mat-price-all-' + ide + '").text((smeta.get_materials_slider(ul.value).price+" р"));'+
                    '   $(".mat-name-' + ide + '").text(smeta.get_materials_slider(ul.value).name);'+
                    '   $(".city-name-' + ide + '").text(smeta.get_materials_slider(ul.value).country);'+
                    '   $("#material-slider-' + ide + '").find(".slider_img").css( "background-image","url(/media/img/material/"+smeta.get_materials_slider(ul.value).img+")");'+
                    "},"+
                    "stop : function (e, ul) {"+
                    "   smeta.select_material(ul.value, "+ v.id+", "+numb+");"+
                    "},"+
                    "});"+
                    '</script>'
                    +'</div>';
            }
        });
        $('.materials_room_for_options').empty();
        $('.materials_room_for_options').html(text);
        $(".selectbox").selectbox({
            onChange: function (val, inst) {
                _this.select_new_category(this, val, numb);
            }
        });
        $(".slider_img")
            .mouseenter(function() {
                $(this).children(".slider_about").show();
            })
            .mouseleave(function() {
                $(this).children(".slider_about").hide();
            });
        _this.preloader(false);
    };

    //гифка прелоадера
    _this.preloader = function(status){
        if(status){
            $('body').append('<img src="/media/img/ajax-loader.gif" id="ajaxLoad">');
            $.fancybox.open({
                href: '#ajaxLoad',
                padding:0,
                maxWidth: 180,
                maxHeight: 50,
                minWidth: 180,
                minHeight: 50,
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
};
