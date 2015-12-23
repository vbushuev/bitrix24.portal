(function(){
    $('.sidebar ul li a').on('click',function(){
        $('.sidebar ul li a').removeClass('active');
        $(this).addClass('active');
    });
})();
