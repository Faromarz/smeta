var Admin = (function() {
    var defaults = {
        ajaxDeleteClass: 'admin-delete-ajax',
        ajaxDeleteClassTr: 'admin-delete-ajax-tr',
        deleteClass: 'admin-delete',
        ajaxBlockId: 'ajaxBlock',
        statusLoad: '<div id="statusLoad">Загрузка...</div>',
        imgHover: 'admin-img-hover'
    };

    function Admin() {
        this.params = {};
    };
    Admin.prototype.init = function(options) {
        _this = this;
        _this.params = $.extend(defaults, options);

        $('.' + _this.params.ajaxDeleteClass).on('click', function() {
            var question = $(this).data('question');
            if (question === undefined) {
                question = 'Удалить?';
            }
            if (!confirm(question)) {
                return false;
            }
            var url = $(this).data('url');
            var params = $(this).data('params');
            if (url === undefined) {
                alert('Url не указан');
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: params
//                beforeSend: function() {
//                    $('#' + _this.params.ajaxBlockId).append(_this.params.statusLoad);
//                },
//                success: function(response) {
//                    $('#' + _this.params.ajaxBlockId).remove(_this.params.statusLoad);
//                }
            });

        });
        $('.' + _this.params.ajaxDeleteClassTr).on('click', function() {
            var _this = this;
            var question = $(this).data('question');
            if (question === undefined) {
                question = 'Удалить?';
            }
            if (!confirm(question)) {
                return false;
            }
            var url = $(this).data('url');
            var params = $(this).data('params');
            if (url === undefined) {
                alert('Url не указан (укажите параметр data-url)');
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: params,
//                beforeSend: function() {
//                    $('#' + _this.params.ajaxBlockId).append(_this.params.statusLoad);
//                },
                success: function(response) {
                    $(_this).parent('td').parent('tr').remove();
                }
            });

        });
        $('.' + _this.params.deleteClass).on('click', function() {
            var question = $(this).data('question');
            if (question === undefined) {
                question = 'Удалить?';
            }
            if (!confirm(question)) {
                return false;
            }
        });
        $('.' + _this.params.imgHover).hover(
            function() {
              $('body').append( $('<div style="position: fixed;top: 50%;left: 50%;margin-top: -100px;width: 200px;height: 200px;margin-left: -100px;"><img style="max-width:200px;" wigth="100%" src="'+$(this).attr('src')+'"></div>'));
            }, function() {
              $('body').find( "div:last" ).remove();
            }
        );
    };
    return new Admin();
})();

