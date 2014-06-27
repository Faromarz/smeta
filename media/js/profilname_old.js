function ProfilName (){

    var _this = this;

    var profilId;
    var par;
    var firstProfil;

    _this.init = function()
    {
        for(i=0; i<profil.length; i++) {
            if (i in profil) {
                firstProfil = i;
                i = profil.length + 1;
        }}
            profilId = profil[firstProfil][1];

        _this.update();

//        $(document).on("click", "#cacl-price-window>li>a", _this.onProfilId);
    };

    _this.onProfilId = function ()
    {
        profilId = $(this).attr('data-id');
        _this.update();
    };

    _this.update = function (){
        var id= 2;
        var clas = $('#cacl-price-group .active_econom').attr('id');
        if(clas == 'calc-price-group-business')id = 3;
        if(clas == 'calc-price-group-premium')id = 4;
         $("#cacl-price-window>li>a")
                 .removeClass("active_premium")
                .not('[data-id!='+id+']')
                .addClass('active_premium');        
    }
}