
/**
 * Smeta
 * @type Function
 */
var Budget = (function() {

    var defaults = {
        rooms: new Array(),
        types: new Array(),
        smeta: new Array()
    };

    function Budget() {};
    Budget.prototype = Smeta;

    Budget.prototype.init = function(options){
        var _this = this;
        Smeta.constructor.prototype.init.call(this, options);
        var params = $.extend(defaults, options);
        _this.countRooms = Number(params.smeta.count_rooms);
        
         //кнопка открытия комнат       
        $("#change_budget").on("click", function(){$("#budget_dop_options").slideDown(350); $("#budget_dop_options-hide").fadeIn(400, function() {  mail_top = $("#mail").offset().top;}); });
        //кнопка закрытия комнат
        $("#budget_dop_options-hide").on("click", function(){$("#budget_dop_options").slideUp(350); $("#budget_dop_options-hide").fadeOut(400, function() {mail_top = $("#mail").offset().top;});});
        $(".room-enable").on("click", function(){ _this.enable_rooms(this)});
       // $(".ignore-door").on("click", function(){ _this.enable_doors(this)});
    };

    // enable из smeta_rooms
    Budget.prototype.enable_rooms = function($object)
    {
        var room_id = $($object).parent().attr('data-room-id'),
            smeta = $.extend(defaults, smeta);
        $.ajax({
            type: "POST",
            url: "../ajax/smeta/enable_room",
            data: { "smeta_id" : smeta['smeta']['id'], "room_id": room_id}
        }, 'json');
       /* console.log(smeta['smeta']['id']);
        console.log(room_id);*/
    };

    // enable из smeta_doors
    Budget.prototype.enable_doors = function($object)
    {
        var room_id = $($object).parent().attr('data-room-id'),
            smeta = $.extend(defaults, smeta);
        $.ajax({
            type: "POST",
            url: "../ajax/smeta/enable_door",
            data: { "smeta_id" : smeta['smeta']['id'], "door_id": door_id}
        }, 'json');
        /* console.log(smeta['smeta']['id']);
         console.log(room_id);*/
    };

    return new Budget();
})();


