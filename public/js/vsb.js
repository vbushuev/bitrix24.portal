(function(){
    $('.sidebar a.nav-item').on('click',function(){
        $('.sidebar a.nav-item').removeClass('active');
        $(this).addClass('active');
    });
    window.vsb ={
        navigation:{
            "cfocus":"contur-focus",
            "bitrix24":"bitrix24"
        },
        getPath:function(){
            var path =window.location.pathname.split('/')[1];
            if($.inArray(path,vsb.navigation)){
                $('.sidebar a.nav-item').removeClass('active');
                $('.sidebar a[href="/'+path+'"]').addClass('active');
            }
            console.debug(path);
            console.debug($('.sidebar a[href="/'+path+'"]').length);
        }
    };
    vsb.getPath();
})();
